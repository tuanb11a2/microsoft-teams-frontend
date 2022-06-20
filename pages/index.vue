<template>
    <div>
        {{ $t("home") }}
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
