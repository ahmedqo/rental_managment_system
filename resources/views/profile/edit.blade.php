@extends('communs.base')
@section('title', 'تعديل الملف الشخصي')

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                تعديل الملف الشخصي
            </h1>
        </div>
    </div>

    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <form action="{{ route('actions.profile.edit') }}" method="POST" class="w-full flex flex-col gap-4">
            @csrf
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="firstName" class="text-gray-950 text-md font-black">الاسم</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="text" value="{{ $data->firstName }}" id="firstName" name="firstName" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="lastName" class="text-gray-950 text-md font-black">النسب</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="text" value="{{ $data->lastName }}" id="lastName" name="lastName" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="identity" class="text-gray-950 text-md font-black">الهوية</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="text" value="{{ $data->identity }}" id="identity" name="identity" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="gender" class="text-gray-950 text-md font-black">الجنس</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="gender" name="gender">
                            <option value="male" @if ($data->gender == 'male') selected @endif>
                                ذكر
                            </option>
                            <option value="female" @if ($data->gender == 'female') selected @endif>
                                أنثى
                            </option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="birthDate" class="text-gray-950 text-md font-black">تاريخ الميلاد</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <input x-date
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            value="{{ $data->birthDate }}" id="birthDate" name="birthDate" />
                    </div>
                </div>
            </div>
            <div class="w-full"></div>
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
            <div class="w-full flex flex-col gap-2">
                <label for="address" class="text-gray-950 text-md font-black">العنوان</label>
                <input
                    class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                    value="{{ $data->address }}" id="address" name="address" type="text" />
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="state" class="text-gray-950 text-md font-black">الولاية</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        value="{{ $data->state }}" id="state" name="state" type="text" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="city" class="text-gray-950 text-md font-black">المدينة</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        value="{{ $data->city }}" id="city" name="city" type="text" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="zipcode" class="text-gray-950 text-md font-black">الرمز البريدي</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        value="{{ $data->zipcode }}" id="zipcode" name="zipcode" type="number" />
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
                background: "#ca8a04",
            }
        });
        DatePicker.option({
            style: {
                background: "#ca8a04",
                current: "#facc15",
            },
        });
        new Select();
        new DatePicker();
    </script>
@endsection
