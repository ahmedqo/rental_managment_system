@extends('communs.base')
@section('title', 'لوحة القيادة')

@section('content')
    <style>
        .fc-view-harness,
        .fc-theme-standard td,
        .fc-theme-standard th {
            border-color: #d1d5db !important;
        }
    </style>
    <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-6 gap-4 -mt-12">
        <div class="w-full flex items-center gap-4 overflow-hidden p-4 bg-gray-50 rounded-lg lg:rounded-2xl lg:col-span-2">
            <div class="flex-1 flex flex-col">
                <h2 class="text-sm text-gray-800">المستخدمين</h2>
                <span class="text-gray-950 font-black text-md">{{ $count->users }}</span>
            </div>
            <svg class="block w-[36px] h-[36px] pointer-events-none  text-gray-950" fill="currentcolor"
                viewBox="0 -960 960 960">
                <path
                    d="M68-130q-20.1 0-33.05-12.45Q22-154.9 22-174.708V-246q0-42.011 21.188-75.36 21.187-33.348 59.856-50.662Q178-404 238.469-419 298.938-434 363-434q66.062 0 126.031 15Q549-404 624-372q38.812 16.018 60.406 49.452Q706-289.113 706-246v71.708Q706-155 693.275-142.5T660-130H68Zm679 0q11-5 20.5-17.5T777-177v-67q0-65-32.5-108T659-432q60 10 113 24.5t88.88 31.939q34.958 18.329 56.539 52.945Q939-288 939-241v66.787q0 19.505-13.225 31.859Q912.55-130 893-130H747ZM364-494q-71.55 0-115.275-43.725Q205-581.45 205-652.5q0-71.05 43.725-115.275Q292.45-812 363.5-812q70.05 0 115.275 44.113Q524-723.775 524-653q0 71.55-45.112 115.275Q433.775-494 364-494Zm386-159q0 70.55-44.602 114.775Q660.796-494 591.035-494 578-494 567.5-495.5T543-502q26-27.412 38.5-65.107 12.5-37.696 12.5-85.599 0-46.903-12.5-83.598Q569-773 543-804q10.75-3.75 23.5-5.875T591-812q69.775 0 114.387 44.613Q750-722.775 750-653Z" />
            </svg>
        </div>
        <div class="w-full flex items-center gap-4 overflow-hidden p-4 bg-gray-50 rounded-lg lg:rounded-2xl lg:col-span-2">
            <div class="flex-1 flex flex-col">
                <h2 class="text-sm text-gray-800">العقارات</h2>
                <span class="text-gray-950 font-black text-md">{{ $count->properties }}</span>
            </div>
            <svg class="block w-[36px] h-[36px] pointer-events-none  text-gray-950" fill="currentcolor"
                viewBox="0 -960 960 960">
                <path
                    d="m147-608 333-249 334 249H147Zm0 501h383v-190H147v190Zm443 0h224v-190H590v190ZM147-357h223v-191H147v191Zm283 0h384v-191H430v191Z" />
            </svg>
        </div>
        <div class="w-full flex items-center gap-4 overflow-hidden p-4 bg-gray-50 rounded-lg lg:rounded-2xl lg:col-span-2">
            <div class="flex-1 flex flex-col">
                <h2 class="text-sm text-gray-800">الحجوزات</h2>
                <div class="text-gray-950 font-black text-md">{{ $count->reservations }}
                    <span class="text-sm font-normal">(
                        المؤكد: {{ $reservations->confirmed }} | الملغى: {{ $reservations->canceled }}
                        )</span>
                </div>
            </div>
            <svg class="block w-[36px] h-[36px] pointer-events-none  text-gray-950" fill="currentcolor"
                viewBox="0 -960 960 960">
                <path
                    d="M406-160 217-80q-45 20-86-7.144Q90-114.29 90-165v-531q0-37.588 27.406-64.794Q144.812-788 181-788h450q35.775 0 63.887 27.206Q723-733.588 723-696v532q0 50.711-41 77.356Q641-60 596-80l-190-80Zm373 4v-689H274v-91h505q36.188 0 63.594 26.912Q870-882.175 870-845v689h-91Z" />
            </svg>
        </div>
        <div class="w-full flex items-center gap-4 overflow-hidden p-4 bg-gray-50 rounded-lg lg:rounded-2xl lg:col-span-3">
            <div class="flex-1 flex flex-col">
                <h2 class="text-sm text-gray-800">المبلغ المؤكد</h2>
                <span class="text-gray-950 font-black text-md">{{ $prices->confirmed }} ريال</span>
            </div>
            <svg class="block w-[36px] h-[36px] pointer-events-none  text-gray-950" fill="currentcolor"
                viewBox="0 -960 960 960">
                <path
                    d="M551.5-443q49.5 0 84.5-34.708 35-34.709 35-84.292 0-50.417-35-85.708Q601-683 551-683t-85 35.5q-35 35.5-35 85.206t35.5 84.5Q502-443 551.5-443ZM256-283q-37.725 0-64.863-26.438Q164-335.875 164-375v-375q0-37.188 27.137-64.594Q218.275-842 256-842h592q36.775 0 63.887 27.406Q939-787.188 939-750v375q0 39.125-27.113 65.562Q884.775-283 848-283H256ZM112-140q-36.775 0-63.888-27.112Q21-194.225 21-231v-400q0-19.775 13.56-32.388Q48.12-676 66.86-676 87-676 99.5-663.388 112-650.775 112-631v400h639q18.375 0 31.688 13.375Q796-204.249 796-185.509q0 18.741-13.312 32.125Q769.375-140 751-140H112Zm132-523q41.062 0 70.031-29.469Q343-721.938 343-762h-99v99Zm615 0v-99h-99q0 40 28.525 69.5T859-663ZM244-363h99q0-40.65-28.969-69.325Q285.062-461 244-461v98Zm516 0h99v-98q-42 0-70.5 28.675T760-363Z" />
            </svg>
        </div>
        <div class="w-full flex items-center gap-4 overflow-hidden p-4 bg-gray-50 rounded-lg lg:rounded-2xl lg:col-span-3">
            <div class="flex-1 flex flex-col">
                <h2 class="text-sm text-gray-800">المبلغ الملغى</h2>
                <span class="text-gray-950 font-black text-md">{{ $prices->canceled }} ريال</span>
            </div>
            <svg class="block w-[36px] h-[36px] pointer-events-none  text-gray-950" fill="currentcolor"
                viewBox="0 -960 960 960">
                <path
                    d="M551.5-443q49.5 0 84.5-34.708 35-34.709 35-84.292 0-50.417-35-85.708Q601-683 551-683t-85 35.5q-35 35.5-35 85.206t35.5 84.5Q502-443 551.5-443ZM256-283q-37.725 0-64.863-26.438Q164-335.875 164-375v-375q0-37.188 27.137-64.594Q218.275-842 256-842h592q36.775 0 63.887 27.406Q939-787.188 939-750v375q0 39.125-27.113 65.562Q884.775-283 848-283H256ZM112-140q-36.775 0-63.888-27.112Q21-194.225 21-231v-400q0-19.775 13.56-32.388Q48.12-676 66.86-676 87-676 99.5-663.388 112-650.775 112-631v400h639q18.375 0 31.688 13.375Q796-204.249 796-185.509q0 18.741-13.312 32.125Q769.375-140 751-140H112Zm132-523q41.062 0 70.031-29.469Q343-721.938 343-762h-99v99Zm615 0v-99h-99q0 40 28.525 69.5T859-663ZM244-363h99q0-40.65-28.969-69.325Q285.062-461 244-461v98Zm516 0h99v-98q-42 0-70.5 28.675T760-363Z" />
            </svg>
        </div>
    </div>
    <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="flex flex-col gap-4">
            <h2 class="font-black text-gray-950 text-xl mt-2">معدل الحجز</h2>
            <div class="w-full aspect-square bg-gray-50 p-4 rounded-lg lg:rounded-2xl relative">
                <canvas id="resPie" class="w-full aspect-square"></canvas>
                <span id="resData"
                    class="font-black text-gray-950 text-3xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></span>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <h2 class="font-black text-gray-950 text-xl mt-2">معدل الدخل</h2>
            <div class="w-full aspect-square bg-gray-50 p-4 rounded-lg lg:rounded-2xl relative">
                <canvas id="pricePie" class="w-full aspect-square"></canvas>
                <span id="priceData"
                    class="font-black text-gray-950 text-3xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></span>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <h2 class="font-black text-gray-950 text-xl mt-2">معدل الإلغاء</h2>
            <div class="w-full aspect-square bg-gray-50 p-4 rounded-lg lg:rounded-2xl relative">
                <canvas id="cancelPie" class="w-full aspect-square"></canvas>
                <span id="cancelData"
                    class="font-black text-gray-950 text-3xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></span>
            </div>
        </div>
    </div>
    <h2 class="font-black text-gray-950 text-xl mt-2">
        التقويم الشهري
    </h2>
    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <div id="calendar" class="w-full"></div>
    </div>
    <h2 class="font-black text-gray-950 text-xl mt-2">
        قائمة أفضل العقارات المحجوزة
    </h2>
    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <table x-table x-name="properties">
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
                        عدد الحجوزات
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderedProperties as $row)
                    <tr>
                        <td>
                            <a class="underline" target="_blank"
                                href="{{ route('views.property.show', $row->property->slug) }}">{{ $row->property->title }}</a>
                        </td>
                        <td>
                            {{ $row->property->normalPrice }} ريال
                        </td>
                        <td>
                            {{ $row->property->specialPrice }} ريال
                        </td>
                        <td>
                            {{ $row->property->address }}
                        </td>
                        <td>
                            {{ $row->count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/locales-all.global.min.js"></script>
    <script>
        const config = (data) => ({
            type: "doughnut",
            data: {
                datasets: [{
                    backgroundColor: ["#751d4f", "#d1d1d1"],
                    data: data,
                    borderWidth: 2,
                    borderColor: "#f9fafb",
                }]
            },
            options: {
                legend: false,
                tooltips: false,
                maintainAspectRatio: false
            }
        });
        var data = {!! json_encode($calenderData) !!};
        var events = data.length ? data.map(el => {
            el.id = JSON.stringify(el);
            el.end = el.end + "T23:59:59";
            return el;
        }) : [];

        document.querySelector("#resData").innerHTML =
            "{{ ($count->properties > 0 ? number_format(($propertiesRate / $count->properties) * 100, 2) : '0.00') . '%' }}";
        document.querySelector("#priceData").innerHTML =
            "{{ ($prices->confirmed + $prices->canceled > 0 ? number_format(($prices->confirmed / ($prices->confirmed + $prices->canceled)) * 100, 2) : '0.00') . '%' }}";
        document.querySelector("#cancelData").innerHTML =
            "{{ ($prices->confirmed + $prices->canceled > 0 ? number_format(($prices->canceled / ($prices->confirmed + $prices->canceled)) * 100, 2) : '0.00') . '%' }}";

        new Chart("resPie", config([{{ $propertiesRate }},
            {{ $propertiesRate > 0 ? $count->properties - $propertiesRate : 0 }}
        ]));
        new Chart("pricePie", config([{{ $prices->confirmed }}, {{ $prices->canceled }}]));
        new Chart("cancelPie", config([{{ $reservations->canceled }}, {{ $reservations->confirmed }}]));
        var calendar = new FullCalendar.Calendar(document.querySelector("#calendar"), {
            headerToolbar: {
                right: 'title',
                left: 'prev,next'
            },
            initialView: "dayGridMonth",
            allDaySlot: false,
            locale: 'ar',
            events: events,
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                var data = JSON.parse(info.event.id);
                setData(data);
            },
            displayEventTime: false,
        });
        calendar.render();

        function setData(data) {
            const extra = eval(JSON.parse(data['json']));
            const icecream = extra.find(e => e.name === 'icecream') || {
                days: 0,
                description: '_'
            };
            const kayak = extra.find(e => e.name === 'kayak') || {
                days: 0,
                description: '_'
            };
            document.body.insertAdjacentHTML('afterbegin', `
                <section id="overlay" class="fixed flex justify-center p-4 inset-0 bg-gray-900 bg-opacity-80 z-20">
                    <button onclick="this.parentElement.remove()"
                        class="w-10 h-10 absolute top-4 left-4 text-gray-50 rounded-full flex items-center justify-center outline-none hover:bg-gray-50 hover:bg-opacity-10 focus:bg-gray-50 focus:bg-opacity-10">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                            <path
                                d="M480 640 282 838q-14 14-32.5 14T218 838q-14-13-14-31.5t14-31.5l198-199-198-198q-13-13-13-32t13-32q12-13 31-13t33 13l198 199 199-200q13-13 31.5-13t32.5 13q13 14 13 32.5T743 377L544 575l198 199q14 14 14 32.5T742 838q-13 14-32 14t-31-14L480 640Z" />
                        </svg>
                    </button>
                    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl overflow-hidden lg:w-7/12">
                        <div class="h-full p-4 overflow-auto">
                            <div class="w-full flex flex-col gap-4">
                                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-1 gap-4">
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">العقار</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="property">${data['title']}</div>
                                    </div>
                                </div>
                                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">الاسم الكامل</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="name">${data['name']}</div>
                                    </div>
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">الجنسية</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="nationality">${data['nationality']}</div>
                                    </div>
                                </div>
                                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">البريد الإلكتروني</label>
                                        <a href="mailto:${data['email']}" class="bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                                            id="email">${data['email']}</a>
                                    </div>
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">الهاتف</label>
                                        <a href="tel:${data['phone']}" class="bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                                            id="phone">${data['phone']}</a>
                                    </div>
                                </div>
                                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">الرقم المدني</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="socialNumber">${data['socialNumber']}</div>
                                    </div>
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">العنوان</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="address">${data['address']}</div>
                                    </div>
                                </div>
                                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">موعد الدخول</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="startDate">${data['start']}</div>
                                    </div>
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">موعد الخروج</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="endDate">${data['end']}</div>
                                    </div>
                                </div>
                                <div class="grid grid-rows-1 grid-cols-1 gap-4">
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">ماكينة الايس كريم</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="icecream">لمدة ${icecream['days']} أيام: ${icecream['description'] || "_"}</div>
                                    </div>
                                    <div class="w-full flex flex-col gap-2">
                                        <label class="text-gray-950 text-md font-black">قارب كاياك</label>
                                        <div class="flex items-center bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl w-full py-2 px-4"
                                            id="kayak">لمدة ${kayak['days']} أيام: ${kayak['description'] || "_"}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `)
        }
    </script>
@endsection
