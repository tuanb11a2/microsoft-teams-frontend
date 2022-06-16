<template>
    <div>
        <div class="flex justify-between items-center border-b px-4 !h-14">
            <ul
                class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none pl-0"
            >
                <li class="nav-item mx-2">
                    <a href="#"
                        ><span
                            class="nav-link py-4"
                            >Avatar</span
                        >
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a href="#"
                        ><span
                            class="nav-link font-extrabold py-4"
                            >Channel name</span
                        >
                    </a>
                </li>
                <li class="nav-item mx-4">
                    <a href="#"
                        ><span
                            class="nav-link py-4 hover:border-b-4"
                            >Avatar</span
                        >
                    </a>
                </li>
                <li class="nav-item mx-4">
                    <a href="#"
                        ><span
                            class="nav-link py-4 hover:border-b-4"
                            >Avatar</span
                        >
                    </a>
                </li>
                <li class="nav-item mx-4">
                    <a href="#"
                        ><span
                            class="nav-link py-4 hover:border-b-4"
                            >Avatar</span
                        >
                    </a>
                </li>
                <li class="nav-item mx-4">
                    <a href="#"
                        ><span
                            class="nav-link py-4 hover:border-b-4"
                            >Avatar</span
                        >
                    </a>
                </li>
            </ul>

            <div class="mr-5">
                <button
                    type="button"
                    class="text-black"
                    @click="toggleDD('settings-menu')"
                    id="menu-button"
                >
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div
                    class="origin-top-right invisible absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                    id="settings-menu"
                    tabindex="-1"
                >
                    <div class="py-1" role="none">
                        <a
                            href="#"
                            class="text-gray-700 block hover:bg-gray-200 px-4 py-2 text-sm"
                            role="menuitem"
                            tabindex="-1"
                            id="menu-item-0"
                            >Edit</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import dropdown from "~/mixins/dropdown";
export default {
    mixins: [dropdown],
};
</script>
