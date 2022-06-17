<template>
    <div class="container mx-auto text-center">
        <div class="blankslate mt-5 text-center">
            <nuxt-img
                width="100"
                height="100"
                class="block mx-auto"
                src="/images/logo.png"
            />
            <h3 class="mb-1">You are being redirected to our applications.</h3>

            <p>
                If your browser does not redirect you back, please
                <button class="text-blue-500 font-bold" @click="returnBack">
                    click here
                </button>
                to continue.
            </p>
        </div>
    </div>
</template>

<script>
export default {
    layout: "guest",
    middleware: "guest",
    mounted() {
        this.$store.dispatch("auth/saveAuthToken", {
            authToken: this.$route.query.token,
            remember: false,
        });
        window.opener.location.reload();
        window.close();
    },
    methods: {
        returnBack() {
            window.opener.location.reload();
            window.close();
        },
    },
};
</script>
