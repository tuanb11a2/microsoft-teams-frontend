<template>
    <form @submit.prevent="register" class="">
        <Portal to="pageTitle"> Sign up to Microsoft Teams </Portal>
        <div
            class="grid lg:grid-cols-2 lg:gap-10 p-5 md:px-20 md:py-10 rounded-3xl shadow-lg bg-white"
        >
            <div class="">
                <div class="mb-5">
                    <label class="block font-bold mb-2">Email address</label>
                    <input
                        v-model="auth.email"
                        id="email"
                        :class="{
                            '!border-red-500':
                                submitted && $v.auth.email.$error,
                        }"
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none sm:"
                        placeholder="abc@example.com"
                    />
                    <div
                        v-if="submitted && !$v.auth.email.required"
                        class="text-red-500 mt-2"
                    >
                        Email is required
                    </div>
                    <div
                        v-if="submitted && !$v.auth.email.email"
                        class="text-red-500 mt-2"
                    >
                        Please enter a valid email!
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block font-bold mb-2">Name</label>
                    <input
                        v-model="auth.name"
                        :class="{
                            '!border-red-500': submitted && $v.auth.name.$error,
                        }"
                        type="text"
                        class="appearance-none invalid:border-pink-500 invalid:text-pink-600 rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none sm:"
                        placeholder="John Doe"
                    />
                    <div
                        v-if="submitted && !$v.auth.name.required"
                        class="text-red-500 mt-2"
                    >
                        Name is required
                    </div>
                    <div
                        v-if="submitted && !$v.auth.name.nameRegex"
                        class="text-red-500 mt-2"
                    >
                        Please enter a valid name!
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block font-bold mb-2">Username</label>
                    <input
                        v-model="auth.username"
                        :class="{
                            '!border-red-500':
                                submitted && $v.auth.username.$error,
                        }"
                        type="text"
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none sm:"
                        placeholder="johndoe0709"
                    />
                    <div
                        v-if="submitted && !$v.auth.username.required"
                        class="text-red-500 mt-2"
                    >
                        Username is required
                    </div>
                    <div
                        v-if="submitted && !$v.auth.username.usernameRegex"
                        class="text-red-500 mt-2"
                    >
                        Please enter a valid username!
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block font-bold mb-2">Phone number</label>
                    <input
                        v-model="auth.phone_number"
                        v-mask="'###########'"
                        type="text"
                        :class="{
                            '!border-red-500':
                                submitted && $v.auth.phone_number.$error,
                        }"
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none sm:"
                        placeholder="0932123312"
                    />
                    <div
                        v-if="submitted && !$v.auth.phone_number.required"
                        class="text-red-500 mt-2"
                    >
                        Phone number is required
                    </div>
                    <div
                        v-if="submitted && !$v.auth.phone_number.phoneRegex"
                        class="text-red-500 mt-2"
                    >
                        Please enter a valid phone number!
                    </div>
                </div>
            </div>
            <div class="">
                <div class="mb-5">
                    <label class="block font-bold mb-2">Password</label>
                    <input
                        type="password"
                        autocomplete="on"
                        v-model="auth.password"
                        :class="{
                            '!border-red-500':
                                submitted && $v.auth.password.$error,
                        }"
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none sm:"
                        placeholder="Password"
                    />
                    <div
                        v-if="submitted && !$v.auth.password.required"
                        class="text-red-500 mt-2"
                    >
                        Password is required
                    </div>
                    <div
                        v-if="submitted && !$v.auth.password.minLength"
                        class="text-red-500 mt-2"
                    >
                        Please enter a valid password!
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block font-bold mb-2"
                        >Password Confirmation</label
                    >
                    <input
                        type="password"
                        autocomplete="on"
                        v-model="auth.password_confirmation"
                        :class="{
                            '!border-red-500':
                                submitted &&
                                $v.auth.password_confirmation.$error,
                        }"
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none sm:"
                        placeholder="Password confirmation"
                    />
                    <div
                        v-if="
                            submitted &&
                            !$v.auth.password_confirmation.sameAsPassword
                        "
                        class="text-red-500 mt-2"
                    >
                        Password confirmation does not match!
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <label class="block text-gray-900">
                            <input
                                type="checkbox"
                                v-model="auth.agree"
                                :class="{
                                    '!border-red-500':
                                        submitted && $v.auth.agree.$error,
                                }"
                                class="h-4 w-4 focus:ring-0 border-gray-300 rounded"
                            />
                            <span class="ml-2"
                                >I have read and agree to the</span
                            >
                            <a
                                class="text-blue-500 font-bold hover:underline"
                                href="#"
                            >
                                Terms and Conditions</a
                            >
                        </label>
                    </div>
                </div>
                <span
                    v-if="submitted && !$v.auth.agree.sameAs"
                    class="text-red-500"
                    >You must agree with our Terms and Conditions</span
                >

                <div class="mt-5">
                    <button
                        :disabled="loading"
                        type="submit"
                        class="disabled:opacity-50 group relative w-full flex justify-center py-2 px-4 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                    >
                        <i
                            v-if="loading"
                            class="fas fa-spinner animate-spin"
                        ></i>
                        <span v-else> Sign up </span>
                    </button>
                </div>
                <div class="mt-10">
                    <div class="text-center mb-3">
                        <div class="flex-auto">
                            <h6 class="font-bold">Or sign in with</h6>
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
                            Already have an account?
                            <nuxt-link
                                class="text-blue-500 hover:underline"
                                to="/login"
                                >Login now!</nuxt-link
                            >
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import {
    required,
    minLength,
    email,
    between,
    sameAs,
    helpers,
} from "vuelidate/lib/validators";

const nameRegex = helpers.regex(
    "nameRegex",
    /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/
);
const phoneRegex = helpers.regex(
    "phoneRegex",
    /(84|0[3|5|7|8|9])+([0-9]{8})\b/
);
const usernameRegex = helpers.regex(
    "usernameRegex",
    /^(?=.{3,100}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/
);

export default {
    middleware: "guest",
    layout: "guest",
    data() {
        return {
            auth: {
                email: "",
                username: "",
                name: "",
                phone_number: "",
                password: "",
                password_confirmation: "",
                agree: false,
                provider: "",
                social_id: "",
            },
            loading: false,
            submitted: false,
            error: "",
        };
    },
    validations: {
        auth: {
            agree: { sameAs: sameAs(() => true) },
            name: { required, nameRegex },
            username: { required, usernameRegex },
            email: { required, email },
            phone_number: { required, phoneRegex },
            password: { required, minLength: minLength(6) },
            password_confirmation: {
                sameAsPassword: sameAs("password"),
            },
        },
    },
    mounted() {
        if (this.$route.query.user) {
            this.auth = JSON.parse(this.$route.query.user);
            this.auth.social_id = this.auth.id;
        }
    },
    methods: {
        async register() {
            this.loading = true;
            this.submitted = true;
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.loading = false;
                return;
            }
            try {
                const res = await this.$axios.post("/auth/register", this.auth);
                this.$store.dispatch("auth/saveAuthToken", {
                    authToken: res.data.access_token,
                    remember: false,
                });
                await this.$store.dispatch("auth/fetchUser");
                this.$router.push("/");
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
