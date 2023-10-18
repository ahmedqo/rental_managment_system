<header class="w-full bg-primary shadow-sm pb-8">
    <nav class="w-full container mx-auto flex items-center gap-2 p-4">
        <button x-toggle="#menu" x-properties="right-0, -right-full, pointer-events-none, lg:w-[260px], lg:w-0"
            class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-gray-50 outline-none hover:bg-gray-50 hover:bg-opacity-10 focus:bg-gray-50 focus:bg-opacity-10">
            <svg class="block w-[28px] h-[28px] pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                <path
                    d="M129-215q-20.75 0-33.375-12.675Q83-240.351 83-261.175 83-280 95.625-293T129-306h458q19.75 0 32.375 13.175 12.625 13.176 12.625 32Q632-240 619.375-227.5 606.75-215 587-215H129Zm0-221q-20.75 0-33.375-13.175Q83-462.351 83-482.175 83-502 95.625-514.5 108.25-527 129-527h339q18.75 0 31.875 12.675Q513-501.649 513-481.825 513-462 499.875-449 486.75-436 468-436H129Zm0-218q-20.75 0-33.375-13.175Q83-680.351 83-700.175 83-720 95.625-733 108.25-746 129-746h458q19.75 0 32.375 13.175 12.625 13.176 12.625 33Q632-680 619.375-667 606.75-654 587-654H129Zm605 173 114 113q13 14 12.5 33T847-304q-15 14-33.5 14T782-304L637-450q-14-13-14-31t14-32l145-146q13-13 31.5-13t33.5 13q13 14 12.5 33T847-594L734-481Z" />
            </svg>
        </button>
        <div class="w-max flex items-center gap-2 ms-auto">
            <div class="w-max relative">
                <button x-toggle="#dropdown" x-properties="pointer-events-none, opacity-0"
                    class="flex items-center justify-center w-[42px] h-[42px] rounded-full focus:outline-1 focus:outline-1-2 outline-primary bg-yellow-200">
                    <span
                        class="text-xs font-black text-gray-950">{{ strtoupper(Auth::user()->firstName[0]) }}{{ strtoupper(Auth::user()->lastName[0]) }}</span>
                </button>
                <ul id="dropdown"
                    class="w-[160px] flex flex-col bg-gray-100 rounded-lg overflow-hidden absolute left-0 top-full mt-px transition-all duration-200 opacity-0 pointer-events-none z-20 border border-gray-300">
                    <li class="w-full">
                        <a href="{{ route('views.profile.edit') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-gray-400 hover:bg-opacity-10 focus:bg-gray-400 focus:bg-opacity-10">
                            <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                                <path
                                    d="M401-497q-76 0-124.5-48.5T228-669q0-76 48.5-124T401-841q75 0 124 48t49 124q0 75-49 123.5T401-497ZM105-134q-20 0-33-12.5T59-179v-72q0-44 24.5-77t56.5-48q70-32 136-47t125-15q5 0 18 .5t20-.5q-9 15-20.5 46T404-337q-5 20-4.5 53.5T407-225q5 29 20.5 53t29.5 38H105Zm609-105q33 0 53-20t20-54q0-33-20-53.5T714-387q-34 0-54 20.5T640-313q0 34 20 54t54 20Zm-45 68q-16-3-31.5-12T611-204l-40 9q-8 3-15.5-1t-12.5-9l-12-23q-5-7-3.5-16t7.5-14l35-34q-4-6-3.5-20.5T570-333l-35-34q-6-5-7.5-14t3.5-15l12-24q5-6 12.5-8.5T571-430l40 8q11-10 26.5-19t31.5-13l7-48q2-10 7.5-15.5T699-523h30q9 0 14.5 5.5T752-502l7 48q15 4 30.5 13.5T816-422l41-8q7-1 14.5 1.5T885-419l12 23q4 6 2 14t-8 16l-35 33q6 7 5 21t-5 20l36 34q5 5 6.5 14.5T897-229l-14 23q-3 7-10.5 10t-14.5 1l-42-9q-11 12-26.5 20.5T759-171l-7 49q-3 9-8.5 14t-14.5 5h-30q-10 0-15.5-4.5T676-123l-7-48Z" />
                            </svg>
                            <span class="text-sm font-medium">الملف الشخصي</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.profile.password') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-gray-400 hover:bg-opacity-10 focus:bg-gray-400 focus:bg-opacity-10">
                            <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                                <path
                                    d="M581.649 12q-27.134 0-45.892-19.583Q517-27.166 517-54.571v-307.891q0-25.038 18.906-44.788Q554.813-427 581.964-427h308.502q26.034 0 45.784 19.924Q956-387.153 956-361.548v307.24Q956-27 936.196-7.5 916.393 12 889.959 12h-308.31ZM582-55h308v-33.584q-27.732-36.316-67.283-55.366Q783.165-163 736.639-163 688-163 648.85-143.766 609.701-124.532 582-88.6V-55Zm155.353-153q25.147 0 44.897-19.374T802-273.853q0-26.105-20.206-45.126-20.206-19.021-46-19.021Q709-338 689.5-318.397q-19.5 19.603-19.5 45.25 0 26.647 19.811 45.897Q709.623-208 737.353-208ZM437-59h-29q-18.166 0-31.455-10.643Q363.256-80.286 363-98l-15-94q-14.417-4.105-31.017-14.098Q300.382-216.091 289-225l-86 41q-15 6-32.389 1.318-17.389-4.682-26.811-21.724L72.2-331.594q-10.2-16.33-5.033-33.051Q72.333-381.365 85-391l80-59q-1-4.533-1-14.457v-30.415q0-9.424 1-15.128l-81-58q-12.667-10.461-17.333-27.394Q62-612.326 72-628l72-127q9.333-15.273 26.667-20.636Q188-781 203-776l87.776 41q10.11-7.455 27.167-17.227Q335-762 348-766l15-98q.59-16 14.212-27T409-902h143q17.166 0 30.788 11T598-864l14 97q15.222 3.895 31.611 13.947Q660-743 671-735l86-41q15-5 32.333.364Q806.667-770.273 816-755l72 124q8 18 3.833 34.855Q887.667-579.289 874-569l-88.563 62H601.202q-10.056-42.7-44.229-71.35Q522.8-607 479-607q-54.414 0-90.707 37.641Q352-531.719 352-480.107 352-438 375-405t62 44.55V-59Z" />
                            </svg>
                            <span class="text-sm font-medium">الرمز السري</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('actions.logout') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-950 hover:bg-gray-400 hover:bg-opacity-10 focus:bg-gray-400 focus:bg-opacity-10">
                            <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                                <path
                                    d="M635-306q-13-15-13.5-33.125T635-371l64-63H409q-19.775 0-32.388-13.36Q364-460.719 364-479.86q0-20.14 12.612-32.64Q389.225-525 409-525h288l-66-67q-13-12.267-12.5-30.081t14.714-31.866Q644.661-666 664.705-665.5 684.75-665 699-653l141 142q4.909 6.327 8.955 15.008Q853-487.311 853-478.676q0 8.636-4.045 17.106Q844.909-453.1 840-448L699.006-305.089Q686-292 668-293t-33-13ZM181-97q-38.1 0-65.05-26.975Q89-150.95 89-188v-584q0-37.463 26.95-64.731Q142.9-864 181-864h251q20.2 0 33.1 13.763 12.9 13.763 12.9 32.816 0 20.053-12.9 32.737Q452.2-772 432-772H181v584h251q20.2 0 33.1 12.675 12.9 12.676 12.9 32.816 0 19.141-12.9 32.325Q452.2-97 432-97H181Z" />
                            </svg>
                            <span class="text-sm font-medium">خروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
