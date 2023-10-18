@extends('communs.base')
@section('title', 'تعديل الحجز ' . $data->id)

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                تعديل الحجز {{ $data->id }}
            </h1>
        </div>
    </div>

    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <form action="{{ route('actions.reservations.edit', $data->id) }}" method="POST" class="w-full flex flex-col gap-4">
            @csrf
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="property" class="text-gray-950 text-md font-black">العقار</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="property" name="property">
                            @foreach ($properties as $property)
                                <option value="{{ $property->id }}" @if ($property->id == $data->property) selected @endif>
                                    {{ $property->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="status" class="text-gray-950 text-md font-black">الحالة</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="status" name="status">
                            <option value="1" @if (intval($data->status) > 0) selected @endif>محجوز</option>
                            <option value="-1" @if (intval($data->status) < 0) selected @endif>ملغى</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="name" class="text-gray-950 text-md font-black">الاسم الكامل</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="text" value="{{ $data->name }}" id="name" name="name" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="nationality" class="text-gray-950 text-md font-black">الجنسية</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="text" value="{{ $data->nationality }}" id="nationality" name="nationality" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="email" class="text-gray-950 text-md font-black">البريد الإلكتروني</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->email }}" id="email" name="email" type="email" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="phone" class="text-gray-950 text-md font-black">الهاتف</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->phone }}" id="phone" name="phone" type="tel" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="startDate" class="text-gray-950 text-md font-black">موعد الدخول</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input x-date type="date"
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->startDate }}" id="startDate" name="startDate" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="endDate" class="text-gray-950 text-md font-black">موعد الخروج</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input x-date type="date"
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->endDate }}" id="endDate" name="endDate" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="socialNumber" class="text-gray-950 text-md font-black">الرقم المدني</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->socialNumber }}" id="socialNumber" name="socialNumber" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="address" class="text-gray-950 text-md font-black">العنوان</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->address }}" id="address" name="address" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-2 lg:grid-cols-6 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="icecream" class="text-gray-950 text-md font-black">ماكينة الايس كريم</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="icecream" name="icecream">
                            <option value="1" @if ($data->icecream) selected @endif>نعم</option>
                            <option value="0" @if (!$data->icecream) selected @endif>لا</option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="icecream_days" class="text-gray-950 text-md font-black">الأيام</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->icecream ? $data->icecream->days : 0 }}" id="icecream_days"
                            name="icecream_days" type="number" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2 col-span-2 lg:col-span-4">
                    <label for="icecream_description" class="text-gray-950 text-md font-black">ملاحظة</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ isset($data->icecream) ? $data->icecream->description ?? '' : '' }}"
                            id="icecream_description" name="icecream_description" type="text" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-2 lg:grid-cols-6 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="kayak" class="text-gray-950 text-md font-black">قارب كاياك</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="kayak" name="kayak">
                            <option value="1" @if ($data->kayak) selected @endif>نعم</option>
                            <option value="0" @if (!$data->kayak) selected @endif>لا</option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="kayak_days" class="text-gray-950 text-md font-black">الأيام</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->kayak ? $data->kayak->days : 0 }}" id="kayak_days" name="kayak_days"
                            type="number" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2 col-span-2 lg:col-span-4">
                    <label for="kayak_description" class="text-gray-950 text-md font-black">ملاحظة</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ isset($data->kayak) ? $data->kayak->description ?? '' : '' }}"
                            id="kayak_description" name="kayak_description" type="text" />
                    </div>
                </div>
            </div>
            <div class="w-full"></div>
            <div class="w-full">
                <button type="submit"
                    class="appearance-none w-max h-[48px] text-lg flex items-center justify-center rounded-md lg:rounded-xl font-black px-10 text-gray-50 outline-none bg-primary hover:bg-primary-light focus:bg-primary-light">
                    <span>حفظ</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        Select.option({
            style: {
                background: "#cc338a",
            }
        });
        DatePicker.option({
            style: {
                background: "#cc338a",
                current: "#fff",
            },
        });
        new Select();
        new DatePicker();
    </script>
@endsection
