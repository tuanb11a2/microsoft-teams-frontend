<template>
    <div class="md:w-1/2 xl:w-1/3 mx-auto">
        <Portal to="pageTitle">{{$t('login.welcome')}}</Portal>
        <div>
            <form
                class="space-y-6 px-10 pt-10 pb-10 rounded-xl shadow-lg bg-white"
                @submit.prevent="login"
            >
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="mb-5">
                        <input
                            v-model="auth.identity"
                            type="text"
                            autocomplete="email"
                            :class="{
                                'border-red-500':
                                    error ||
                                    (submitted && $v.auth.identity.$error),
                            }"
                            class="appearance-none rounded-xl h-14 relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500"
                            :placeholder="$t('login.identity.placeholder')"
                        />
                        <div
                            v-if="submitted && $v.auth.identity.$error"
                            class="text-red-500 font-bold mt-2"
                        >
                            {{$t('login.identity.error')}}
                        </div>
                    </div>
                    <div>
                        <input
                            id="password"
                            type="password"
                            @keyup.enter="login"
                            v-model="auth.password"
                            name="password"
                            autocomplete="current-password"
                            :class="{
                                'border-red-500':
                                    error ||
                                    (submitted && $v.auth.password.$error),
                            }"
                            class="appearance-none rounded-xl h-14 relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500"
                            :placeholder="$t('login.password.placeholder')"
                        />
                        <div
                            v-if="submitted && $v.auth.password.$error"
                            class="text-red-500 font-bold mt-2"
                        >
                            {{$t('login.password.placeholder')}}
                        </div>
                        <div class="font-bold text-red-500 mt-2" v-if="error">
                            {{ error }}
                        </div>
                    </div>
                </div>
                

                <div class="sm:flex items-center justify-between">
                    <div class="flex items-center">
                        <label
                            class="ml-2 mb-5 sm:mb-0 block text-sm text-gray-900"
                        >
                            <input
                                v-model="remember"
                                type="checkbox"
                                class="h-4 w-4 focus:shadow-none focus:ring-0 border-gray-300 rounded"
                            />
                            <span class="ml-2">{{$t('login.remember')}}</span>
                        </label>
                    </div>

                    <div class="text-sm">
                        <nuxt-link
                            :to="localePath('/password/forget')"
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                        >
                            {{$t('login.forgetPassword')}}
                        </nuxt-link>
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full flex justify-center items-center py-2 px-4 border border-transparent md:text-xl font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700  md:h-12"
                    >
                        {{$t('login.button')}}
                    </button>
                </div>
            </form>
            <div class="mt-10">
                <div class="text-center mb-3">
                    <div class="flex-auto">
                        <h6 class="font-bold">{{$t('login.orSignIn')}}</h6>
                    </div>
                </div>
                <div
                    class="text-center grid lg:grid-cols-3 xl:gap-10 gap-5 pt-3"
                >
                    <button
                        @click="socialLogin('google')"
                        class="bg-white px-5 py-3 rounded outline-none focus:outline-none shadow hover:shadow-md inline-flex items-center justify-center font-bold ease-linear transition-all duration-150"
                        type="button"
                    >
                        <img
                            alt="..."
                            class="w-5 h-5 mr-4"
                            src="/images/google.png"
                        />Google
                    </button>
                    <button
                        @click="socialLogin('github')"
                        class="bg-black text-white px-5 py-3 rounded outline-none focus:outline-none shadow inline-flex hover:shadow-md justify-center items-center font-bold ease-linear transition-all duration-150"
                        type="button"
                    >
                        <img
                            alt="..."
                            class="w-5 h-5 mr-4"
                            src="/images/github.png"
                        />Github
                    </button>
                    <button
                        @click="socialLogin('facebook')"
                        class="bg-white px-5 py-3 rounded outline-none focus:outline-none shadow hover:shadow-md inline-flex justify-center items-center font-bold ease-linear transition-all duration-150"
                        type="button"
                    >
                        <img
                            alt="..."
                            class="w-5 h-5 mr-4"
                            src="/images/facebook.png"
                        />Facebook
                    </button>
                </div>
            </div>
            <div class="mt-10">
                <div class="flex-auto text-center">
                    <h6 class="font-bold">
                        {{$t('login.dontHaveAccount')}}
                        <nuxt-link
                            class="text-blue-500 hover:underline"
                            :to="localePath('/register')"
                            >{{$t('login.signUpNow')}}</nuxt-link
                        >
                    </h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

export default {
    middleware: "guest",
    layout: "guest",
    data() {
        return {
            auth: {
                identity: "",
                password: "",
            },
            remember: false,
            submitted: false,
            loading: false,
            error: "",
        };
    },
    validations: {
        auth: {
            identity: { required },
            password: { required },
        },
    },
    mounted() {},
    methods: {
        async login() {
            try {
                this.loading = true;
                this.submitted = true;
                this.$v.$touch();
                if (this.$v.$invalid) {
                    this.loading = false;
                    return;
                }
                const res = await this.$axios.post("/auth/login", this.auth);
                this.$store.dispatch("auth/saveAuthToken", {
                    authToken: res.data.access_token,
                    remember: this.remember,
                });
                await this.$store.dispatch("auth/fetchUser");
                this.$router.push(this.localePath('/'));
            } catch (e) {
                this.error = e.response.data.meta.message;
            }

            this.loading = false;
        },

        async socialLogin(provider) {
            try {
                const res = await this.$axios.post(
                    "/auth/social/login/" + provider
                );
                this.popupwindow(res.data, "Social Login", 800, 800);
            } catch (e) {}
        },
        popupwindow(url, title, w, h) {
            var left = screen.width / 2 - w / 2;
            var top = screen.height / 2 - h / 2;
            return window.open(
                url,
                title,
                "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=" +
                    w +
                    ", height=" +
                    h +
                    ", top=" +
                    top +
                    ", left=" +
                    left
            );
        },
    },
};
</script>
