<template>
  <div
        class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
    >
        <div class="max-w-md w-full space-y-8">
            <div>
                <img
                    class="mx-auto h-12 w-auto"
                    src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                    alt="Workflow"
                />
                <h2
                    class="mt-6 mb-10 text-center text-3xl font-extrabold text-gray-900"
                >
                    Sign in to your account
                </h2>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="login">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="mb-5">
                        <label
                            class="block text-xs font-bold mb-2"
                            for="email-address"
                            >Email address/Username/Phone number</label
                        >
                        <input
                            v-model="auth.identity"
                            id="email-address"
                            name="email"
                            type="email"
                            autocomplete="email"
                            :class="error ? 'border-red-500' : ''"
                            class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="abc@example.com, abc, 09612312312, ..."
                        />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-bold mb-2"
                            for="password"
                            >Password</label
                        >
                        <input
                            id="password"
                            type="password"
                            @keyup.enter="login"
                            v-model="auth.password"
                            name="password"
                            autocomplete="current-password"
                            :class="error ? 'border-red-500' : ''"
                            class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Password"
                        />
                    </div>
                </div>
                <span class="text-xs font-bold text-red-500" v-if="error">{{
                    error
                }}</span>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            id="remember-me"
                            name="remember-me"
                            type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                        />
                        <label
                            for="remember-me"
                            class="ml-2 block text-sm text-gray-900"
                        >
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <nuxt-link
                            to="/password-reset"
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                        >
                            Forgot your password?
                        </nuxt-link>
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <span
                            class="absolute left-0 inset-y-0 flex items-center pl-3"
                        >
                            <!-- Heroicon name: solid/lock-closed -->
                            <svg
                                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
            <hr class="mt-6 border-b-1 border-blueGray-300" />
            <div class="rounded-t mb-0 px-6">
                <div class="text-center mb-3">
                    <div class="flex-auto">
                        <h6 class="text-sm font-bold">Or sign in with</h6>
                    </div>
                </div>
                <div class="text-center pt-3">
                    <button
                        @click="socialLogin('google')"
                        class="bg-white px-4 py-2 rounded outline-none focus:outline-none mr-4 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150"
                        type="button"
                    >
                        <img
                            alt="..."
                            class="w-5 mr-1"
                            src="https://demos.creative-tim.com/notus-js/assets/img/google.svg"
                        />Google
                    </button>
                    <button
                        @click="socialLogin('github')"
                        class="bg-white px-4 py-2 rounded outline-none focus:outline-none mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150"
                        type="button"
                    >
                        <img
                            alt="..."
                            class="w-5 mr-4"
                            src="https://demos.creative-tim.com/notus-js/assets/img/github.svg"
                        />Github
                    </button>
                    <button
                        @click="socialLogin('facebook')"
                        class="bg-white px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 mt-5 md:mt-0 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs ease-linear transition-all duration-150"
                        type="button"
                    >
                        <img
                            alt="..."
                            class="w-5 mr-4"
                            src="https://demos.creative-tim.com/notus-js/assets/img/google.svg"
                        />Facebook
                    </button>
                </div>
            </div>
            <div class="mt-3 mb-0 px-6">
                <div class="flex-auto text-center">
                    <h6 class="text-sm font-bold">
                        Don't have an account?
                        <nuxt-link
                            class="text-blue-500 hover:underline"
                            to="/register"
                            >Sign up now!</nuxt-link
                        >
                    </h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    middleware: "guest",
    data() {
        return {
            auth: {
                identity: "",
                password: "",
            },
            remember: false,
            error: "",
        };
    },
    mounted() {},
    methods: {
        async login() {
            try {
                const res = await this.$axios.post("/auth/login", this.auth);
                this.$store.dispatch("auth/saveToken", {
                    token: res.data.token,
                    remember: this.remember,
                });
                await this.$store.dispatch("auth/fetchUser");
                this.$router.push('/');
            } catch (e) {
                this.error = e.response.data.meta.message;
            }
        },
    async socialLogin(provider) {
            try {
                const res = await this.$axios.post(
                    "/auth/social/login/" + provider
                );
                window.location.href = res.data;
            } catch (e) {
                console.log(e.response.data);
            }
        },
    },
};
</script>
