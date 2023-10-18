<?php

namespace App\Functions;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileFunction
{
    public static function single($property, $file)
    {
        $name = substr(Storage::putFile('public/files', $file), strlen('public/files/'));
        $type = $file->getClientMimeType();
        $size = $file->getSize();

        File::create([
            'property' => $property,
            'name' => $name,
            'type' => $type,
            'size' => $size
        ]);
    }

    public static function store($property, $files)
    {
        foreach ($files as $file) {
            FileFunction::single($property, $file);
        }
    }

    public static function destroy($id, $single = false)
    {
        $files = File::where($single ? 'id' : 'property', $id)->get();
        foreach ($files as $file) {
            if (Storage::exists('public/files/' . $file->name))
                Storage::delete('public/files/' . $file->name);
            $file->delete();
        }
    }

    public static function all($id)
    {
        return File::where('property', $id)->get();
    }
}
