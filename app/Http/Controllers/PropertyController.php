<?php

namespace App\Http\Controllers;

use App\Functions\DateFunction;
use App\Functions\FileFunction;
use App\Models\Property;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class PropertyController extends Controller
{
    public function all()
    {
        $data = Property::limit(6)->get();
        $social = Setting::first();
        $props = [];
        foreach ($data as $property) {
            $exist = Reservation::where('property', $property->id)
                ->where('status', 1)
                ->where('startDate', '<=', now())
                ->where('endDate', '>=', now())
                ->first();
            if ($exist) {
                $property->reserved = true;
            } else {
                $property->reserved = false;
            }
            $property->images = FileFunction::all($property->id);
        }

        foreach (Reservation::with('property')->get() as $single) {
            $property = $single->property()->first();
            if ($single->status === 1) {
                $props[] = [
                    'title' => $property->title,
                    'start' => $single->startDate,
                    'end' => $single->endDate,
                    'color' => '#751d4f',
                ];
            }
        }

        return view('home', compact('data', 'social', 'props'));
    }

    public function show($slug)
    {
        $data = Property::where('slug', $slug)->first();
        $images = FileFunction::all($data->id);
        $reservations = Reservation::where('property', $data->id)->where('status', 1)->get();
        $dates = [];
        foreach ($reservations as $res) {
            $dates = array_merge($dates, DateFunction::period($res->startDate, $res->endDate));
        }
        $data->dates = join(', ', $dates);
        return view('property', compact('data', 'images'));
    }

    public function search(Request $request)
    {
        //$address = $request->address ?? '';
        $startDate = $request->startDate ?? now();
        $endDate = $request->endDate ?? now();

        $properties = Property::get(); //where(DB::raw("CONCAT(address, ' ', state, ' ', city, ' ', zipcode)"), 'like', "%$address%")->get();

        foreach ($properties as $property) {
            $exist = Reservation::where('property', $property->id)->where('status', 1)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('startDate', [$startDate, $endDate])
                        ->orWhereBetween('endDate', [$startDate, $endDate])
                        ->orWhere(function ($query) use ($startDate, $endDate) {
                            $query->where('startDate', '<=', $startDate)
                                ->where('endDate', '>=', $endDate);
                        });
                })
                ->first();

            if ($exist) {
                $property->reserved = true;
            } else {
                $property->reserved = false;
            }
            $property->images = FileFunction::all($property->id);
        }

        return response()->json($properties);
    }

    public function index()
    {
        $data = Property::orderBy('id', 'DESC')->get();
        return view('property.index', compact('data'));
    }

    public function create()
    {
        return view('property.create');
    }

    public function edit($id)
    {
        $data = Property::findorfail($id);
        $images = FileFunction::all($id);
        return view('property.edit', compact('data', 'images'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => ['required', 'string', 'unique:properties'],
            'title' => ['required', 'string', 'unique:properties'],
            'normalPrice' => ['required', 'numeric'],
            'specialPrice' => ['required', 'numeric'],
            'area' => ['required', 'numeric'],
            'rooms' => ['required', 'integer'],
            'kitchen' => ['required', 'string'],
            'garage' => ['required', 'string'],
            'garden' => ['required', 'string'],
            'map' => ['required', 'string'],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.properties.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if (!$request->hasFile('images')) {
            return Redirect::route("views.properties.create")->with([
                'message' => 'يجب توفير صورة واحدة على الأقل',
                'type' => 'error'
            ]);
        }

        $current = Property::create([
            'slug' => $request->slug,
            'title' => $request->title,
            'normalPrice' => $request->normalPrice,
            'specialPrice' => $request->specialPrice,
            'area' => $request->area,
            'rooms' => $request->rooms,
            'kitchen' => (bool) $request->kitchen,
            'garage' => (bool) $request->garage,
            'garden' => (bool) $request->garden,
            'map' => $request->map,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        FileFunction::store($current->id, $request->file('images'));

        return Redirect::route('views.properties.index')->with([
            'message' => 'تم الإنشاء بنجاح',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'slug' => ['required', 'string', 'unique:properties,slug,' . $id],
            'title' => ['required', 'string', 'unique:properties,title,' . $id],
            'normalPrice' => ['required', 'numeric'],
            'specialPrice' => ['required', 'numeric'],
            'area' => ['required', 'numeric'],
            'rooms' => ['required', 'integer'],
            'kitchen' => ['required', 'string'],
            'garage' => ['required', 'string'],
            'garden' => ['required', 'string'],
            'map' => ['required', 'string'],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.properties.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $images = FileFunction::all($id)->count();

        if (!$request->hasFile('images') && !$images) {
            return Redirect::route("views.properties.edit", $id)->with([
                'message' => 'يجب توفير صورة واحدة على الأقل',
                'type' => 'error'
            ]);
        }

        Property::findorfail($id)->update([
            'slug' => $request->slug,
            'title' => $request->title,
            'normalPrice' => $request->normalPrice,
            'specialPrice' => $request->specialPrice,
            'area' => $request->area,
            'rooms' => $request->rooms,
            'kitchen' => (bool) $request->kitchen,
            'garage' => (bool) $request->garage,
            'garden' => (bool) $request->garden,
            'map' => $request->map,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        if ($request->hasFile('images')) {
            FileFunction::store($id, $request->file('images'));
        }

        return Redirect::route('views.properties.index')->with([
            'message' => 'تم التحديث بنجاح',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        FileFunction::destroy($id);
        Property::findorfail($id)->delete();

        return Redirect::route('views.properties.index')->with([
            'message' => 'تم الحذف بنجاح',
            'type' => 'success'
        ]);
    }
}
