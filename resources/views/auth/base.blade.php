<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}{{ env('PUBLIC_VERSION') }}" />
    <title>@yield('title')</title>
</head>

<body class="bg-[#fcfcfc]">
    <main background-image class="w-full min-h-screen flex items-center justify-center">
        <section class="container mx-auto lg:w-1/3 p-4">
            <img src="{{ asset('img/logo.png') }}" class="block mb-4 w-[160px] max-w-full mx-auto" />
            @yield('content')
        </section>
    </main>
    <script src="{{ asset('js/index.js') }}{{ env('PUBLIC_VERSION') }}"></script>
    @if (Session::has('message'))
        <script>
            const info = {!! json_encode(Session::all()) !!};
            const message = replaceString(Array.isArray(info.message) ? info.message : [info.message]).join("<br />");
            const type = info.type;
            (new Toaster({
                positionX: "left",
                positionY: "bottom",
                width: 500
            }))[type](message);
        </script>
    @endif
    @yield('script')
</body>

</html>
