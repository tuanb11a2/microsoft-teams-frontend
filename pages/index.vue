<template>
    <div>
        {{ $t("home") }}
        <router-link to="/login">Login</router-link>
        <router-link to="/register">Register</router-link>
        <button @click="logout">Log out</button>
    </div>
</template>

<script>
export default {
    middleware: 'auth',
    methods: {
        async logout() {
            await this.$store.dispatch('auth/logout')
        },
    },
    mounted() {
    }
};
</script>
