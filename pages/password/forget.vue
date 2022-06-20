<template>
    <div>
        <Portal to="pageTitle"> Find your account </Portal>
        <div class="md:w-1/2 xl:w-1/3 mx-auto">
            <div
                class="px-5 md:px-10 py-5 rounded-xl shadow-lg bg-white"
            >
                <div class="font-bold md:text-xl mb-5">
                    Please enter your email address to find your account.
                </div>
                <input
                    v-model="user.email"
                    type="email"
                    autocomplete="email"
                    :class="{
                        'border-red-500':
                            error || (submitted && $v.user.email.$error),
                    }"
                    class="appearance-none rounded-xl h-14 relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500"
                    placeholder="Email address"
                    @keyup.enter="searchAccount"
                />
                <div
                    v-if="submitted && $v.user.email.$error"
                    class="text-red-500 mt-3 font-bold"
                >
                    Email address is required!
                </div>
                <div
                    v-if="error"
                    class="text-red-500 mt-3 font-bold"
                >
                    {{ error }}
                </div>

                <div class="flex justify-end mt-5">
                    <div class="inline-flex">
                        <button
                            @click="$router.push('/login')"
                            class="mr-5 px-7 py-2 rounded font-bold bg-gray-200 hover:bg-gray-300"
                        >
                            Cancel
                        </button>
                        <button
                            @click="searchAccount"
                            :disabled="loading"
                            class="px-7 py-2 rounded text-white font-bold disabled:bg-blue-300 disabled:cursor-not-allowed bg-blue-500 hover:bg-blue-700"
                        >
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
export default {
    head: {
        title: "Password forget",
        meta: [
            {
                hid: "description",
                name: "description",
                content: "Home page description",
            },
        ],
    },
    layout: "guest",
    middleware: "guest",
    data() {
        return {
            user: {
                email: "",
            },
            submitted: false,
            loading: false,
            error: ''
        };
    },
    validations: {
        user: {
            email: { required },
        },
    },
    watch: {
        user: {
            handler() {
                this.error = ''
            },
            deep:true
        }
    },
    methods: {
        async searchAccount() {
            this.loading = true;
            this.submitted = true;
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.loading = false;
                return;
            }
            try {
                await this.$axios.post("/auth/check-account", this.user);
                this.$store.commit('auth/SET_FORGOT_PASSWORD_USER', this.user.email);
                this.$router.push(this.localePath('/password/verify'));
            } catch (e) {
                this.error = e.response.data.meta.message;
            }
            
            this.loading = false;
        },
    },
};
</script>
