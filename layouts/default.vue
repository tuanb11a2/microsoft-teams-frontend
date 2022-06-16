<template>
  <div class="font-sans leading-normal tracking-normal">
        <nav
            class="bg-purple-900 pt-2 md:pt-1 pb-1 px-1 mt-0 fixed w-full z-20 top-0"
        >
            <div class="grid grid-cols-4">
                <div class="grid grid-cols-6">
                    <a
                        href="#"
                        class="text-white w-full h-full flex items-center justify-center hover:bg-purple-700 text-xl"
                    >
                        <div class="text-center hover:opacity-90">
                            <i class="fas fa-list text-center"></i>
                        </div>
                    </a>
                    <div class="col-span-5 my-auto">
                        <nuxt-link to="/" class="text-white ml-2 text-xl"
                            >Microsoft Teams</nuxt-link
                        >
                    </div>
                </div>

                <div class="flex items-center col-span-2 text-white px-2">
                    <span class="relative w-full">
                        <input
                            type="search"
                            placeholder="Search"
                            class="w-full h-10 bg-white text-black transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none"
                        />
                        <div
                            class="absolute search-icon"
                            style="top: 0.75rem; left: 0.8rem"
                        >
                            <svg
                                class="fill-current pointer-events-none text-black w-4 h-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"
                                ></path>
                            </svg>
                        </div>
                    </span>
                </div>

                <div class="flex pt-2 justify-end">
                    <ul
                        class="list-reset flex justify-between flex-1 md:flex-none items-center"
                    >
                        <li class="flex-1 md:flex-none md:mr-3">
                            <div class="relative inline-block">
                                <button
                                    type="button"
                                    class="text-white"
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
                        </li>
                        <li class="flex-1 md:flex-none md:mr-3">
                            <div class="relative inline-block">
                                <button
                                    v-if="user"
                                    @click="toggleDD('profile-menu')"
                                    class="drop-button text-white focus:outline-none"
                                >
                                    {{ user.name }}
                                </button>
                                <div
                                    class="origin-top-right invisible absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                                    id="profile-menu"
                                >
                                    <div class="py-1">
                                        <a
                                            @click="logout"
                                            type="button"
                                            class="text-gray-700 cursor-pointer block hover:bg-gray-200 px-4 py-2 text-sm"
                                            >Logout</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="grid grid-cols-4 pt-12 bg-gray-50 h-screen">
            <div class="grid grid-cols-6 border-r-2">
                <div class="list-none flex flex-col justify-between bg-gray-50">
                    <div>
                        <a href="#">
                            <li
                                class="text-center hover:bg-white text-blue-400 hover:!text-purple-900 py-2"
                            >
                                <i class="fas text-xl fa-bell"></i>
                                <div class="text-sm">Test</div>
                            </li>
                        </a>
                        <a href="#">
                            <li
                                class="text-center hover:bg-white text-blue-400 hover:!text-purple-900 py-2"
                            >
                                <i class="fas text-xl fa-bell"></i>
                                <div class="text-sm">Test</div>
                            </li>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <li
                                class="text-center hover:bg-white text-blue-400 hover:!text-purple-900 py-2"
                            >
                                <i class="fas text-xl fa-bell"></i>
                                <div class="text-sm">Test</div>
                            </li>
                        </a>
                        <a href="#">
                            <li
                                class="text-center hover:bg-white text-blue-400 hover:!text-purple-900 py-2"
                            >
                                <i class="fas text-xl fa-bell"></i>
                                <div class="text-sm">Test</div>
                            </li>
                        </a>
                    </div>
                </div>
                <div class="col-span-5 shadow-md">
                    <ActivitySideNav />
                    <slot name="sideNav"></slot>
                </div>
            </div>
            <div class="col-span-3 flex-1">
                <SubNav />
                <div class="p-4">
                    <Nuxt />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import dropdown from "~/mixins/dropdown";
export default {
    mixins: [dropdown],
    data() {
        return {
            user: ''
        };
    },
    mounted() {
        this.user = this.$store.state.auth.user;
        
        window.onclick = function (event) {
            if (
                !event.target.matches(".drop-button") &&
                !event.target.matches(".drop-search")
            ) {
                var dropdowns = document.getElementsByClassName("dropdownlist");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains("invisible")) {
                        openDropdown.classList.add("invisible");
                    }
                }
            }
        };
    },
    methods: {
        /*Filter dropdown options*/
        filterDD(myDropMenu, myDropMenuSearch) {
            var input, filter, ul, li, a, i;
            input = document.getElementById(myDropMenuSearch);
            filter = input.value.toUpperCase();
            div = document.getElementById(myDropMenu);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        },
        logout() {
            this.$store.commit('auth/logout');
        },
    },
};
</script>
