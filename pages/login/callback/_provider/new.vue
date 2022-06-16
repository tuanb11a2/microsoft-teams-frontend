<template>
  <div
    class="
      grid
      md:grid-cols-2
      items-center
      justify-center
      py-12
      px-4
      sm:px-24
      xl:px-64
    "
  >
    <div class="space-y-8">
      <div>
        <img
          class="mx-auto h-12 w-auto"
          src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
          alt="Workflow"
        />
        <h2 class="mt-6 text-center text-3xl font-extrabold mb-10 text-gray-900">
          Welcome to Teams
        </h2>
      </div>
      <form class="mt-8 space-y-8" @submit.prevent="register">
        <div class="rounded-md shadow-sm">
          <div class="mb-5">
            <label class="block text-xs font-bold mb-2" 
              >Email address</label
            >
            <input
              disabled
              v-model="auth.email"
              type="email"
              :class="error ? 'border-red-500' : ''"
              class="
                appearance-none
                rounded
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                focus:outline-none
                sm:text-sm
              "
              placeholder="abc@example.com"
            />
          </div>
          <div class="mb-5">
            <label class="block text-xs font-bold mb-2">Name</label>
            <input
              v-model="auth.name"
              type="text"
              :class="error ? 'border-red-500' : ''"
              class="
                appearance-none
                rounded
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                focus:outline-none
                sm:text-sm
              "
              placeholder="John Doe"
            />
          </div>
          <div class="mb-5">
            <label class="block text-xs font-bold mb-2">Username</label>
            <input
              v-model="auth.username"
              :class="error ? 'border-red-500' : ''"
              type="text"
              class="
                appearance-none
                rounded
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                focus:outline-none
                sm:text-sm
              "
              placeholder="johndoe0709"
            />
          </div>
          <div class="mb-5">
            <label class="block text-xs font-bold mb-2"
              >Phone number</label
            >
            <input
              v-model="auth.phone_number"
              v-mask="'###########'"
              type="text"
              :class="error ? 'border-red-500' : ''"
              class="
                appearance-none
                rounded
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                focus:outline-none
                sm:text-sm
              "
              placeholder="0932123312"
            />
          </div>
          <div class="mb-5">
            <label class="block text-xs font-bold mb-2"
              >Password</label
            >
            <input
              type="password"
              v-model="auth.password"
              :class="error ? 'border-red-500' : ''"
              class="
                appearance-none
                rounded
                relative
                block
                w-full
                px-3
                py-2
                border border-gray-300
                placeholder-gray-500
                text-gray-900
                focus:outline-none
                sm:text-sm
              "
              placeholder="Password"
            />
          </div>
        </div>
        <div>
          <label class="block text-xs font-bold mb-2"
            >Password Confirmation</label
          >
          <input
            type="password"
            v-model="auth.password_confirmation"
            :class="error ? 'border-red-500' : ''"
            class="
              appearance-none
              rounded
              relative
              block
              w-full
              px-3
              py-2
              border border-gray-300
              placeholder-gray-500
              text-gray-900
              focus:outline-none
              sm:text-sm
            "
            placeholder="Password confirmation"
          />
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
              class="
                h-4
                w-4
                text-indigo-600
                focus:ring-indigo-500
                border-gray-300
                rounded
              "
            />
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              I have read and agree to the
              <a class="text-blue-500 font-bold hover:underline" href="#">
                Terms and Conditions</a
              >
            </label>
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="
              group
              relative
              w-full
              flex
              justify-center
              py-2
              px-4
              border border-transparent
              text-sm
              font-medium
              rounded-md
              text-white
              bg-indigo-600
              hover:bg-indigo-700
              focus:outline-none
              focus:ring-2
              focus:ring-offset-2
              focus:ring-indigo-500
            "
          >
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
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
            Sign up
          </button>
        </div>
      </form>
    </div>
    <div class="mb-0 px-6 mt-10 md:mt-0">
      <div class="text-center mb-3">
        <div class="flex-auto">
          <h6 class="text-sm font-bold">Or sign up with</h6>
        </div>
      </div>
      <div class="text-center md:pt-3">
        <button
          @click="socialLogin('google')"
          class="
            bg-white
            px-4
            py-2
            rounded
            outline-none
            focus:outline-none
            mr-4
            mb-1
            uppercase
            shadow
            hover:shadow-md
            inline-flex
            items-center
            font-bold
            text-xs
            ease-linear
            transition-all
            duration-150
          "
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
          class="
            bg-white
            px-4
            py-2
            rounded
            outline-none
            focus:outline-none
            mb-1
            mr-4
            uppercase
            shadow
            hover:shadow-md
            inline-flex
            items-center
            font-bold
            text-xs
            ease-linear
            transition-all
            duration-150
          "
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
          class="
            bg-white
            px-4
            py-2
            rounded
            outline-none
            focus:outline-none
            mr-1
            mb-1
            mt-5
            md:mt-0
            uppercase
            shadow
            hover:shadow-md
            inline-flex
            items-center
            font-bold
            text-xs
            ease-linear
            transition-all
            duration-150
          "
          type="button"
        >
          <img
            alt="..."
            class="w-5 mr-4"
            src="https://demos.creative-tim.com/notus-js/assets/img/google.svg"
          />Facebook
        </button>
      </div>
      <div class="mt-3 mb-0 px-6 pt-5">
        <div class="flex-auto text-center">
          <h6 class="text-sm font-bold">
            Already have an account?
            <nuxt-link class="text-blue-500 hover:underline" to="/login"
              >Login now!</nuxt-link
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
        email: "",
        username: "",
        name: "",
        phone_number: "",
        password: "",
        password_confirmation: "",
        provider: '',
        social_id: ''
      },
      error: "",
    };
  },
  mounted() {
    this.auth= JSON.parse(this.$route.query.user);
    this.auth.provider = this.$route.params.provider;
    this.auth.social_id = this.auth.id;
  },
  methods: {
    async register() {
      try {
        const res = await this.$axios.post('/auth/register', this.auth);
        this.$auth.setUserToken(res.data.access_token);
        this.$router.push('/')
      } catch (e) {
        this.error = e.response.data.meta.message;
      }
    },
    async socialLogin(provider) {
      try {
        const res = await this.$axios.post("/auth/social/login/" + provider);
        window.location.href = res.data;
      } catch (e) {
        console.log(e.response.data);
      }
    },
  },
};
</script>
