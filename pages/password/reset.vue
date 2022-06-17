<template>
    <div>
        <nuxt-img
            class="mx-auto h-24 w-auto"
            src="/images/logo.png"
            alt="Microsoft Teams"
        />
        <h2 class="mb-20 text-center text-3xl font-extrabold text-gray-900">
            Reset your password
        </h2>
    </div>
</template>

<script>
export default {
    head: {
        title: "Password reset",
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
};
</script>
