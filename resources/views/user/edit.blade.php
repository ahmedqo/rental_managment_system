@extends('communs.base')
@section('title', 'تعديل المستخدم ' . $data->id)

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                تعديل المستخدم {{ $data->id }}
            </h1>
            <div class="w-max flex items-center gap-2">
                <a href="{{ route('actions.users.destroy', $data->id) }}"
                    class="w-[48px] h-[48px] flex items-center justify-center rounded-md lg:rounded-xl text-gray-50 bg-red-600 outline-none hover:bg-red-400 focus:bg-red-400">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                        <path
                            d="m480 647 88 88q10.733 12 28.367 12 17.633 0 30.459-11.826Q638 724 638 706.25T627 677l-88-89 88-90q11-11.733 11-29.367 0-17.633-11.174-28.459Q615 429 597.367 428.5 579.733 428 569 440l-89 89-87-89q-10.5-12-28.75-11.5t-30.424 11.674Q322 452 322 469.133q0 17.134 12 28.867l88 90-88 88q-11 12.5-11 29.75t10.826 29.424Q346 747 363.75 747T393 735l87-88ZM253 957q-35.725 0-63.863-27.138Q161 902.725 161 866V314h-11q-19 0-31.5-12.5T106 268q0-19 12.5-32t31.5-13h182q0-20 13-33.5t33-13.5h204q20 0 33.5 13.3T629 223h180q20 0 33 13t13 32q0 21-13 33.5T809 314h-11v552q0 36.725-27.638 63.862Q742.725 957 706 957H253Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <form action="{{ route('actions.users.edit', $data->id) }}" method="POST" class="w-full flex flex-col gap-4">
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
