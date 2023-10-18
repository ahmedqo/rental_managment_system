@extends('communs.base')
@section('title', 'قائمة الحجوزات')

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                قائمة الحجوزات
            </h1>
        </div>
    </div>
    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <table x-table x-remove="8" x-name="reservations">
            <thead>
                <tr>
                    <td>
                        العقار
                    </td>
                    <td>
                        الاسم الكامل
                    </td>
                    <td>
                        الجنسية
                    </td>
                    <td>
                        الهاتف
                    </td>
                    <td>
                        البريد الإلكتروني
                    </td>
                    <td>
                        موعد الدخول
                    </td>
                    <td>
                        موعد الخروج
                    </td>
                    <td>
                        الإضافات
                    </td>
                    <td>
                        المجموع
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
                            <a class="underline" target="_blank"
                                href="{{ route('views.property.show', $row->property()->first()->slug) }}">{{ $row->property()->first()->title }}</a>
                        </td>
                        <td>
                            {{ $row->name }}
                        </td>
                        <td>
                            {{ $row->nationality }}
                        </td>
                        <td>
                            {{ $row->phone }}
                        </td>
                        <td>
                            {{ $row->email }}
                        </td>
                        <td>
                            {{ $row->startDate }}
                        </td>
                        <td>
                            {{ $row->endDate }}
                        </td>
                        <td>
                            <div class="flex flex-col gap-2">
                                @php
                                    $extra = json_decode($row->extra);
                                    $icecream = array_filter(
                                        $extra,
                                        function ($ext) {
                                            return $ext->name === 'icecream';
                                        },
                                        1,
                                    );
                                    $kayak = array_filter(
                                        $extra,
                                        function ($ext) {
                                            return $ext->name === 'kayak';
                                        },
                                        1,
                                    );
                                    
                                    if (!empty($icecream)) {
                                        $icecream = reset($icecream);
                                    } else {
                                        $icecream = null;
                                    }
                                    if (!empty($kayak)) {
                                        $kayak = reset($kayak);
                                    } else {
                                        $kayak = null;
                                    }
                                @endphp
                                @if ($icecream)
                                    <span>ماكينة الايس كريم لمدة {{ $icecream->days }} أيام</span>
                                @endif
                                @if ($kayak)
                                    <span>قارب كاياك لمدة {{ $kayak->days }} أيام</span>
                                @endif
                                @if (!$icecream && !$kayak)
                                    لا إضافات
                                @endif
                            </div>
                        </td>
                        <td>
                            {{ $row->price }} ريال
                        </td>
                        <td>
                            <div class="w-max h-full mx-auto flex items-center justify-center rounded-md overflow-hidden">
                                <a href="{{ route('views.reservations.edit', $row->id) }}"
                                    class="w-10 h-8 flex items-center justify-center text-gray-50 bg-yellow-600 hover:bg-yellow-400 focus:bg-yellow-400">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor"
                                        viewBox="0 96 960 960">
                                        <path
                                            d="M170 953q-32 7-53-14.5T103 886l39-188 216 216-188 39Zm235-78L181 651l435-435q27-27 64.5-27t63.5 27l96 96q27 26 27 63.5T840 440L405 875Z" />
                                    </svg>
                                </a>
                                @if ($row->status === 1)
                                    <a href="{{ route('actions.reservations.cancel', $row->id) }}"
                                        class="w-10 h-8 flex items-center justify-center text-gray-50 bg-red-600 hover:bg-red-400 focus:bg-red-400">
                                        <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor"
                                            viewBox="0 96 960 960">
                                            <path
                                                d="m480 647 88 88q10.733 12 28.367 12 17.633 0 30.459-11.826Q638 724 638 706.25T627 677l-88-89 88-90q11-11.733 11-29.367 0-17.633-11.174-28.459Q615 429 597.367 428.5 579.733 428 569 440l-89 89-87-89q-10.5-12-28.75-11.5t-30.424 11.674Q322 452 322 469.133q0 17.134 12 28.867l88 90-88 88q-11 12.5-11 29.75t10.826 29.424Q346 747 363.75 747T393 735l87-88ZM253 957q-35.725 0-63.863-27.138Q161 902.725 161 866V314h-11q-19 0-31.5-12.5T106 268q0-19 12.5-32t31.5-13h182q0-20 13-33.5t33-13.5h204q20 0 33.5 13.3T629 223h180q20 0 33 13t13 32q0 21-13 33.5T809 314h-11v552q0 36.725-27.638 63.862Q742.725 957 706 957H253Z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('actions.reservations.active', $row->id) }}"
                                        class="w-10 h-8 flex items-center justify-center text-gray-50 bg-green-600 hover:bg-green-400 focus:bg-green-400">
                                        <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor"
                                            viewBox="0 96 960 960">
                                            <path
                                                d="M400 947q-114-26-188-117t-74-212q0-68 27.5-129T245 385q10-15 30-14.5t35 13.5q11 12 11.5 29.5T308 445q-37 34-58 78.5T229 618q0 87 52.5 153.5T417 856q15 5 25.5 18t10.5 28q0 25-17 37.5t-36 7.5Zm164 0q-21 7-37.5-7T510 903q0-13 10-27.5t26-19.5q83-18 134.5-84.5T732 618q0-100-68-172t-168-78h-23l42 42q8 10 8 25t-8 24q-10 9-25.5 9t-24.5-9L355 350q-6-6-10-14.5t-4-17.5q0-10 4-18t10-14l110-112q9-8 24.5-7.5T515 174q7 10 7 26t-7 24l-53 52h24q140 0 239 100.5T824 618q0 120-74 212T564 947Z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
