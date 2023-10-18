@extends('communs.base')
@section('title', 'الإعدادات')

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                الإعدادات
            </h1>
        </div>
    </div>

    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <form action="{{ route('actions.settings.update') }}" method="POST" class="w-full flex flex-col gap-4">
            @csrf
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="facebook" class="text-gray-950 text-md font-black">فيسبوك</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input type="text" id="facebook" name="facebook" value="{{ $data->facebook }}"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="instagram" class="text-gray-950 text-md font-black">إنستجرام</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input type="text" id="instagram" name="instagram" value="{{ $data->instagram }}"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="twitter" class="text-gray-950 text-md font-black">تويتر</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input type="text" id="twitter" name="twitter" value="{{ $data->twitter }}"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="tiktok" class="text-gray-950 text-md font-black">تيك توك</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input type="text" id="tiktok" name="tiktok" value="{{ $data->tiktok }}"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
            </div>
            <div class="w-full"></div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="icecream" class="text-gray-950 text-md font-black">ايس كريم</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input type="number" id="icecream" name="icecream" value="{{ $data->icecream }}"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="kayak" class="text-gray-950 text-md font-black">كاياك</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input type="number" id="kayak" name="kayak" value="{{ $data->kayak }}"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="assurance" class="text-gray-950 text-md font-black">تأمين</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input type="number" id="assurance" name="assurance" value="{{ $data->assurance }}"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
            </div>
            <div class="w-full"></div>
            <div class="w-full flex flex-col gap-2">
                <label for="terms" class="text-gray-950 text-md font-black">الشروط والأحكام</label>
                <textarea class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                    id="terms" name="terms" rows="8">{{ $data->terms }}</textarea>
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
