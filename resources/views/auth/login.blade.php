@extends('auth.base')
@section('title', 'تسجيل الدخول')

@section('content')
    <form action="{{ route('actions.login') }}" method="POST" enctype="multipart/form-data"
        class="relative w-full mx-auto flex flex-col bg-[#fcfcfc] gap-4 border-2 border-accent rounded-lg lg:rounded-2xl p-4 pb-10">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="email" class="text-gray-950 text-md font-black">البريد الإلكتروني</label>
            <input type="email" id="email" name="email"
                class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
        </div>
        <div class="flex flex-col gap-2">
            <label for="password" class="text-gray-950 text-md font-black">الرمز السري</label>
            <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                <input x-password type="password" id="password" name="password"
                    class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
            </div>
        </div>
        <a href="{{ route('views.forgot') }}" class="text-accent font-bold text-sm block w-max">هل نسيت الرمز السري؟</a>
        <button type="submit"
            class="absolute top-full left-1/2 -translate-x-1/2 -mt-[24px] appearance-none w-max h-[48px] mx-auto text-lg flex items-center justify-center rounded-md lg:rounded-xl font-black px-10 text-gray-50 outline-none bg-primary hover:bg-primary-light focus:bg-primary-light">
            <span>تسجيل الدخول</span>
        </button>
    </form>
@endsection

@section('script')
    <script>
        new Password();
    </script>
@endsection
