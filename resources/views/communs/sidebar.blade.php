<aside id="menu"
    class="w-full lg:w-[260px] h-screen fixed lg:sticky top-0 -right-full lg:right-0 z-30 lg:z-0 transition-all duration-200 pointer-events-none lg:pointer-events-auto">
    <div class="w-full h-full bg-gray-50 bg-opacity-80 relative">
        <button x-toggle="#menu" x-properties="right-0, -right-full, pointer-events-none, lg:w-[260px], lg:w-0"
            class="w-10 h-10 flex items-center justify-center rounded-full absolute top-4 left-4 text-gray-50 outline-none hover:bg-gray-50 hover:bg-opacity-10 focus:bg-gray-50 focus:bg-opacity-10">
            <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                <path
                    d="M480 640 282 838q-14 14-32.5 14T218 838q-14-13-14-31.5t14-31.5l198-199-198-198q-13-13-13-32t13-32q12-13 31-13t33 13l198 199 199-200q13-13 31.5-13t32.5 13q13 14 13 32.5T743 377L544 575l198 199q14 14 14 32.5T742 838q-13 14-32 14t-31-14L480 640Z" />
            </svg>
        </button>
    </div>
    <nav
        class="w-9/12 max-w-[260px] lg:w-full h-full flex flex-col gap-6 bg-gray-50 absolute top-0 right-0 overflow-y-auto">
        <header class="w-full flex items-center justify-center p-2">
            <img src="{{ asset('img/logo.png') }}" class="w-[160px] block" />
        </header>
        <ul class="flex flex-col">
            <li class="w-full">
                <a href="{{ route('views.dashboard.show') }}"
                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-primary-light focus:bg-primary-light {{ Link::is_active('views.dashboard.show') }}">
                    <svg class="block w-5 h-5 pointer-events-none text-accent" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="M230-230h230v-170H230v170Zm0-210h230v-291H230v291Zm270 210h229v-290H500v290Zm0-330h229v-171H500v171ZM191-99q-37.587 0-64.794-26.594Q99-152.188 99-190v-581q0-37.588 27.206-64.794Q153.413-863 191-863h579q37.588 0 64.794 27.206Q862-808.588 862-771v51h68v68h-68v138h68v69h-68v137h68v68h-68v50q0 37.812-27.206 64.406Q807.588-99 770-99H191Z" />
                    </svg>
                    <span class="text-lg font-semibold">لوحة القيادة</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('views.users.index') }}"
                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-primary-light focus:bg-primary-light {{ Link::is_active('views.users.index') }}">
                    <svg class="block w-5 h-5 pointer-events-none text-accent" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="M68-130q-20.1 0-33.05-12.45Q22-154.9 22-174.708V-246q0-42.011 21.188-75.36 21.187-33.348 59.856-50.662Q178-404 238.469-419 298.938-434 363-434q66.062 0 126.031 15Q549-404 624-372q38.812 16.018 60.406 49.452Q706-289.113 706-246v71.708Q706-155 693.275-142.5T660-130H68Zm679 0q11-5 20.5-17.5T777-177v-67q0-65-32.5-108T659-432q60 10 113 24.5t88.88 31.939q34.958 18.329 56.539 52.945Q939-288 939-241v66.787q0 19.505-13.225 31.859Q912.55-130 893-130H747ZM364-494q-71.55 0-115.275-43.725Q205-581.45 205-652.5q0-71.05 43.725-115.275Q292.45-812 363.5-812q70.05 0 115.275 44.113Q524-723.775 524-653q0 71.55-45.112 115.275Q433.775-494 364-494Zm386-159q0 70.55-44.602 114.775Q660.796-494 591.035-494 578-494 567.5-495.5T543-502q26-27.412 38.5-65.107 12.5-37.696 12.5-85.599 0-46.903-12.5-83.598Q569-773 543-804q10.75-3.75 23.5-5.875T591-812q69.775 0 114.387 44.613Q750-722.775 750-653Z" />
                    </svg>
                    <span class="text-lg font-semibold">المستخدمين</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('views.properties.index') }}"
                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-primary-light focus:bg-primary-light {{ Link::is_active('views.properties.index') }}">
                    <svg class="block w-5 h-5 pointer-events-none text-accent" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="m147-608 333-249 334 249H147Zm0 501h383v-190H147v190Zm443 0h224v-190H590v190ZM147-357h223v-191H147v191Zm283 0h384v-191H430v191Z" />
                    </svg>
                    <span class="text-lg font-semibold">العقارات</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('views.reservations.index') }}"
                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-primary-light focus:bg-primary-light {{ Link::is_active('views.reservations.index') }}">
                    <svg class="block w-5 h-5 pointer-events-none text-accent" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="M406-160 217-80q-45 20-86-7.144Q90-114.29 90-165v-531q0-37.588 27.406-64.794Q144.812-788 181-788h450q35.775 0 63.887 27.206Q723-733.588 723-696v532q0 50.711-41 77.356Q641-60 596-80l-190-80Zm373 4v-689H274v-91h505q36.188 0 63.594 26.912Q870-882.175 870-845v689h-91Z" />
                    </svg>
                    <span class="text-lg font-semibold">الحجوزات</span>
                </a>
            </li>
            <li class="w-full">
                <a href="{{ route('views.settings.show') }}"
                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-primary-light focus:bg-primary-light {{ Link::is_active('views.settings.show') }}">
                    <svg class="block w-5 h-5 pointer-events-none text-accent" fill="currentcolor"
                        viewBox="0 -960 960 960">
                        <path
                            d="M743-97q-20 0-40-8.5T668-130L430-369q-21 9-41 12t-46 3q-107 0-180.5-74T89-607q0-32 10.5-67t25.5-63l149 150 94-88-153-153q26-14 61.5-26t66.5-12q108 0 183 75.5T601-607q0 23-3 44.5T586-519l235 235q15 15 24 36t9 42q0 23-9.5 43.5T820-128q-16 15-36.5 23T743-97Z" />
                    </svg>
                    <span class="text-lg font-semibold">الإعدادات</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
