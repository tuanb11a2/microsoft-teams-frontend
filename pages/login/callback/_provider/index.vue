<template>

</template>

<script>
export default {
    middleware: 'guest',
    mounted() {
        this.$cookiz.set('authToken', this.$route.query.token);
        this.$axios.defaults.headers.common = {'Authorization': `bearer ${this.$route.query.token}`}
        this.$router.push('/');
    }
}
</script>
