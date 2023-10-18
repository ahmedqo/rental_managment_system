@extends('communs.base')
@section('title', 'تعديل الرمز السري')

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                تعديل الرمز السري
            </h1>
        </div>
    </div>

    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <form action="{{ route('actions.profile.password') }}" method="POST" class="w-full flex flex-col gap-4">
            @csrf
            <div class="w-full flex flex-col gap-2">
                <label for="oldPassword" class="text-gray-950 text-md font-black">الرمز السري القديم</label>
                <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                    <input x-password type="password" id="oldPassword" name="oldPassword"
                        class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="newPassword" class="text-gray-950 text-md font-black">الرمز السري الجديد</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input x-password type="password" id="newPassword" name="newPassword"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for=confirmPassword" class="text-gray-950 text-md font-black">تأكيد الرمز السري</label>
                    <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                        <input x-password type="password" id="confirmPassword" name="confirmPassword"
                            class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
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
        new Password();
    </script>
@endsection
