@extends('communs.base')
@section('title', 'إنشاء عقار')

@section('content')
    <div class="w-full bg-gray-50 rounded-lg lg:rounded-2xl -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-950 text-xl">
                إنشاء عقار
            </h1>
        </div>
    </div>

    <div class="w-full bg-gray-50 p-4 rounded-lg lg:rounded-2xl">
        <form action="{{ route('actions.properties.create') }}" method="POST" enctype="multipart/form-data"
            class="w-full flex flex-col gap-4">
            @csrf
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-4 gap-4">
                <div class="w-full flex flex-col gap-2 lg:col-span-2">
                    <label for="title" class="text-gray-950 text-md font-black">الاسم</label>
                    <div class="relative">
                        <input oninput="makeSlug(event)"
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="text" id="title" name="title" />
                        <input type="text" name="slug" class="hidden" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="normalPrice" class="text-gray-950 text-md font-black">السعر العادي (لليوم)</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="number" id="normalPrice" name="normalPrice" />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="specialPrice" class="text-gray-950 text-md font-black">السعر الاستثنائي (لليوم)</label>
                    <div class="relative">
                        <input
                            class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                            type="number" id="specialPrice" name="specialPrice" />
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="area" class="text-gray-950 text-md font-black">المساحة</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        id="area" name="area" type="number" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="rooms" class="text-gray-950 text-md font-black">الغرف</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        id="rooms" name="rooms" type="number" />
                </div>
            </div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="kitchen" class="text-gray-950 text-md font-black">المطبخ</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="kitchen" name="kitchen">
                            <option value="true">نعم</option>
                            <option value="false">لا</option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="garage" class="text-gray-950 text-md font-black">الكراج</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="garage" name="garage">
                            <option value="true">نعم</option>
                            <option value="false">لا</option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="garden" class="text-gray-950 text-md font-black">الحديقة</label>
                    <div class="relative bg-gray-200 text-gray-950 rounded-md lg:rounded-xl">
                        <select x-select id="garden" name="garden">
                            <option value="true">نعم</option>
                            <option value="false">لا</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="w-full"></div>
            <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="w-full flex flex-col gap-2 lg:col-span-2">
                    <label for="address" class="text-gray-950 text-md font-black">العنوان</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        id="address" name="address" type="text" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="map" class="text-gray-950 text-md font-black">خرائط جوجل</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        id="map" name="map" type="text" />
                </div>
            </div>
            {{-- <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="state" class="text-gray-950 text-md font-black">الولاية</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        id="state" name="state" type="text" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="city" class="text-gray-950 text-md font-black">المدينة</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        id="city" name="city" type="text" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="zipcode" class="text-gray-950 text-md font-black">الرمز البريدي</label>
                    <input
                        class="appearance-none bg-gray-200 text-gray-950 h-[48px] text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                        id="zipcode" name="zipcode" type="number" />
                </div>
            </div> --}}
            <div class="w-full"></div>
            <div class="w-full flex flex-col gap-2">
                <label for="imagesUpload" class="text-gray-950 text-md font-black">الصور</label>
                <input type="file" id="images" name="images[]" class="hidden" multiple>
                <div id="imagesDisplay"
                    class="w-full bg-gray-200 p-4 rounded-lg lg:rounded-2xl grid grid-cols-3 grid-rows-1 lg:grid-cols-10 gap-4">
                    <div
                        class="w-full aspect-square bg-gray-400 bg-opacity-20 hover:bg-opacity-10 transition-opacity rounded-md lg:rounded-xl flex items-center justify-center relative">
                        <input type="file" id="imagesUpload" accept="image/*" multiple
                            class="opacity-0 w-full h-full absolute inset-0 cursor-pointer" />
                        <svg class="block w-16 h-16 pointer-events-none text-gray-950" fill="currentcolor"
                            viewBox="0 96 960 960">
                            <path
                                d="M480.009 721q-19.641 0-32.825-13.312Q434 694.375 434 676V365l-82 82q-13 12-31.511 12.5t-30.409-13.42Q276 432.867 276 413.933 276 395 290 380l158-158q6.167-4.909 14.532-8.955Q470.898 209 479.744 209q8.847 0 17.601 3.864Q506.1 216.727 512 222l159 160q14 13 13.5 32t-13.63 32.13q-12.137 13.101-31.003 12.485Q621 458 607 445l-82-80v311q0 18.375-12.675 31.688Q499.649 721 480.009 721ZM205 940q-36.05 0-63.525-26.897T114 847.5V706q0-18.8 13.56-32.4 13.559-13.6 32.3-13.6 20.14 0 32.64 13.6t12.5 32.297V848h549V705.897q0-18.697 12.86-32.297 12.859-13.6 32.5-13.6Q819 660 832 673.6t13 32.297V848q0 38.5-28 65.25T754 940H205Z" />
                        </svg>
                    </div>

                </div>
            </div>
            <div class="w-full"></div>
            <div class="w-full flex flex-col gap-2">
                <label for="description" class="text-gray-950 text-md font-black">الوصف</label>
                <textarea class="appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block w-full py-2 px-4"
                    id="description" name="description" rows="4"></textarea>
            </div>
            <div class="w-full"></div>
            <div class="w-full">
                <button type="submit"
                    class="appearance-none w-max h-[48px] text-lg flex items-center justify-center rounded-md lg:rounded-xl font-black px-10 text-gray-50 outline-none bg-primary hover:bg-primary-light focus:bg-primary-light">
                    <span>إنشاء</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        Select.option({
            style: {
                background: "#cc338a",
            }
        });
        new Select();
        const canvas = new DataTransfer();
        const images = document.querySelector("#images");
        const upload = document.querySelector("#imagesUpload");
        const display = document.querySelector("#imagesDisplay");
        const removeItem = function(event) {
            const index = [...display.children].length - [...display.children].indexOf(event.target) - 1;
            canvas.items.remove(index);
            images.files = canvas.files;
            event.target.remove();
        }
        const getTemplate = function(src) {
            return `
                <div onclick="removeItem(event)"
                    class="w-full group aspect-square bg-gray-50 bg-opacity-10 rounded-md lg:rounded-xl flex items-center justify-center cursor-pointer relative overflow-hidden">
                    <img src="${src}" class="w-full h-full object-cover pointer-events-none transition-transform group-hover:scale-150" />
                    <div
                        class="opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity w-full h-full absolute inset-0 bg-gray-950 bg-opacity-40 flex items-center justify-center">
                        <svg class="block w-16 h-16 pointer-events-none text-gray-50" fill="currentcolor"
                            viewBox="0 96 960 960">
                            <path
                                d="m480 647 88 88q10.733 12 28.367 12 17.633 0 30.459-11.826Q638 724 638 706.25T627 677l-88-89 88-90q11-11.733 11-29.367 0-17.633-11.174-28.459Q615 429 597.367 428.5 579.733 428 569 440l-89 89-87-89q-10.5-12-28.75-11.5t-30.424 11.674Q322 452 322 469.133q0 17.134 12 28.867l88 90-88 88q-11 12.5-11 29.75t10.826 29.424Q346 747 363.75 747T393 735l87-88ZM253 957q-35.725 0-63.863-27.138Q161 902.725 161 866V314h-11q-19 0-31.5-12.5T106 268q0-19 12.5-32t31.5-13h182q0-20 13-33.5t33-13.5h204q20 0 33.5 13.3T629 223h180q20 0 33 13t13 32q0 21-13 33.5T809 314h-11v552q0 36.725-27.638 63.862Q742.725 957 706 957H253Z" />
                        </svg>
                    </div>
                </div>
            `
        }
        const loadFiles = function(event) {
            [...event.target.files].forEach(file => {
                event.target.parentElement.insertAdjacentHTML("afterend", getTemplate(URL.createObjectURL(
                    file)));
                canvas.items.add(file);
            });
            images.files = canvas.files;
            event.target.value = null;
        };
        const makeSlug = function(event) {
            const value = event.target.value;
            event.target.nextElementSibling.value = value.replace(/\s+/g, "_");
        }
        upload.addEventListener("change", loadFiles);
    </script>
@endsection
