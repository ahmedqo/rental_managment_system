@extends('auth.base')
@section('title', 'إعادة تعيين الرمز السري')

@section('content')
    <form action="{{ route('actions.reset', $token) }}" method="POST"
        class="relative w-full mx-auto flex flex-col bg-[#fcfcfc] gap-4 border-2 border-accent rounded-lg lg:rounded-2xl p-4 pb-10">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="newPassword" class="text-gray-950 text-md font-black">الرمز السري</label>
            <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                <input x-password type="date" type="password" id="newPassword" name="newPassword"
                    class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <label for="confirmPassword" class="text-gray-950 text-md font-black">تأكيد الرمز السري</label>
            <div class="rounded-lg lg:rounded-2xl bg-gray-200 text-gray-950">
                <input x-password type="date" type="password" id="confirmPassword" name="confirmPassword"
                    class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full h-[48px] py-2 px-4" />
            </div>
        </div>
        <button type="submit"
            class="absolute top-full left-1/2 -translate-x-1/2 -mt-[24px] appearance-none w-max h-[48px] mx-auto text-lg flex items-center justify-center rounded-md lg:rounded-xl font-black px-10 text-gray-50 outline-none bg-primary hover:bg-primary-light focus:bg-primary-light">
            <span>إعادة تعيين</span>
        </button>
    </form>
@endsection

@section('script')
    <script>
        new Password();
    </script>
@endsection
