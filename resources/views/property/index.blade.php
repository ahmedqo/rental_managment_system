@extends('communs.base')
@section('title', 'قائمة العقارات')

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                قائمة العقارات
            </h1>
            <div class="w-max flex items-center gap-2">
                <a href="{{ route('views.properties.create') }}"
                    class="w-[48px] h-[48px] flex items-center justify-center rounded-md lg:rounded-xl text-gray-50 bg-primary outline-none hover:bg-primary-light focus:bg-primary-light">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                        <path
                            d="M479.825 871q-18.45 0-31.637-12.625Q435 845.75 435 825V622H230q-18.375 0-31.688-13.56Q185 594.881 185 576.14q0-20.14 13.312-32.64Q211.625 531 230 531h205V326q0-19.775 13.358-32.388Q461.716 281 480.158 281t32.142 12.612Q526 306.225 526 326v205h204q18.8 0 32.4 12.675 13.6 12.676 13.6 32.316 0 19.641-13.6 32.825Q748.8 622 730 622H526v203q0 20.75-13.65 33.375Q498.699 871 479.825 871Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <table x-table x-remove="4" x-name="properties">
            <thead>
                <tr>
                    <td>
                        الاسم
                    </td>
                    <td>
                        السعر العادي (لليوم)
                    </td>
                    <td>
                        السعر الاستثنائي (لليوم)
                    </td>
                    <td>
                        العنوان
                    </td>
                    <td>
                        <div class="min-w-max w-full h-full flex items-center justify-center">
                            الإجراءات
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>
                            {{ $row->title }}
                        </td>
                        <td>
                            {{ $row->normalPrice }} ريال
                        </td>
                        <td>
                            {{ $row->specialPrice }} ريال
                        </td>
                        <td>
                            {{ $row->address }}
                        </td>
                        <td>
                            <div class="w-max h-full mx-auto flex items-center justify-center rounded-md overflow-hidden">
                                <a href="{{ route('views.properties.edit', $row->id) }}"
                                    class="w-10 h-8 flex items-center justify-center text-gray-50 bg-yellow-600 hover:bg-ywllow-400 focus:bg-ywllow-400">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor"
                                        viewBox="0 96 960 960">
                                        <path
                                            d="M170 953q-32 7-53-14.5T103 886l39-188 216 216-188 39Zm235-78L181 651l435-435q27-27 64.5-27t63.5 27l96 96q27 26 27 63.5T840 440L405 875Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('actions.properties.destroy', $row->id) }}"
                                    class="w-10 h-8 flex items-center justify-center text-gray-50 bg-red-600 hover:bg-red-400 focus:bg-red-400">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor"
                                        viewBox="0 96 960 960">
                                        <path
                                            d="m480 647 88 88q10.733 12 28.367 12 17.633 0 30.459-11.826Q638 724 638 706.25T627 677l-88-89 88-90q11-11.733 11-29.367 0-17.633-11.174-28.459Q615 429 597.367 428.5 579.733 428 569 440l-89 89-87-89q-10.5-12-28.75-11.5t-30.424 11.674Q322 452 322 469.133q0 17.134 12 28.867l88 90-88 88q-11 12.5-11 29.75t10.826 29.424Q346 747 363.75 747T393 735l87-88ZM253 957q-35.725 0-63.863-27.138Q161 902.725 161 866V314h-11q-19 0-31.5-12.5T106 268q0-19 12.5-32t31.5-13h182q0-20 13-33.5t33-13.5h204q20 0 33.5 13.3T629 223h180q20 0 33 13t13 32q0 21-13 33.5T809 314h-11v552q0 36.725-27.638 63.862Q742.725 957 706 957H253Z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
