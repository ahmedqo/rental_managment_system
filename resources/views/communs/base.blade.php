<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}{{ env('PUBLIC_VERSION') }}" />
    <title>@yield('title')</title>
</head>

<body class="flex flex-col flex-wrap lg:flex-row bg-gray-200">
    @include('communs.sidebar')
    <main class="flex-1 flex flex-col max-w-full lg:min-w-100">
        @include('communs.header')
        <section class="w-full container mx-auto p-4 flex flex-col gap-4">
            @yield('content')
        </section>
    </main>
    <script src="{{ asset('js/index.js') }}{{ env('PUBLIC_VERSION') }}"></script>
    <script>
        @if (Session::has('message'))
            const info = {!! json_encode(Session::all()) !!};
            const message = replaceString(Array.isArray(info.message) ? info.message : [info.message]).join("<br />");
            const type = info.type;
            (new Toaster({
                positionX: "left",
                positionY: "bottom",
                width: 500
            }))[type](message);
        @endif
        Table.option({
            style: {
                text: "#fff",
                color: "#fff",
                background: "#cc338a",
                header: "#751d4f",
            },
        });
        new Toggle();
        new Table();
    </script>
    @yield('script')
</body>

</html>
