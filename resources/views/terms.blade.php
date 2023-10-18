<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <title>الشروط والأحكام</title>
</head>

<body class="bg-[#fcfcfc]">
    <main class="flex flex-col gap-4 p-4 lg:p-8 lg:gap-8 container mx-auto">
        <a href="{{ route('views.home.show') }}" class="block w-32 lg:w-52 mx-auto">
            <img src="{{ asset('img/logo.png') }}" class="w-full" />
        </a>
        <section
            class="border-2 border-accent rounded-lg lg:rounded-2xl p-4 lg:p-8 text-lg lg:text-xl text-gray-950 font-semibold">
            <div class="revert">
                {!! Mark::parse(App\Models\Setting::first()->terms) !!}
            </div>
        </section>
    </main>
</body>

</html>
