<template>
    <div class="font-sans leading-normal tracking-normal">
        <nav
            class="bg-purple-900 px-4 md:px-20 h-12 pt-2 md:pt-1 pb-1 mt-0 flex justify-between items-center fixed w-full z-20 top-0"
        >
            <nuxt-link :to="localePath('/')" class="text-white text-xl"
                >Microsoft Teams</nuxt-link
            >
            <div class="text-white md:inline-flex hidden">
                <nuxt-link
                    v-for="locale in availableLocales"
                    :key="locale.code"
                    :to="switchLocalePath(locale.code)"
                    >{{ locale.name }}</nuxt-link
                >
                <nuxt-link :to="localePath('login')" class="ml-3"> {{ $t('login.text') }}</nuxt-link>
                <nuxt-link :to="localePath('register')" class="ml-3"> {{ $t('signUp.text') }}</nuxt-link>
            </div>
        </nav>
        <div class="pt-12 px-4 sm:px-6 lg:px-8 bg-gray-100 h-full min-h-screen">
            <nuxt-img
                class="mx-auto h-24 w-auto"
                src="/images/logo.png"
                alt="Microsoft Teams"
            />
            <h2 class="text-center text-xl md:text-3xl font-extrabold mb-10 text-gray-900">
                <PortalTarget name="pageTitle"></PortalTarget>
            </h2>
            <Nuxt />
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        availableLocales() {
            return this.$i18n.locales.filter(
                (i) => i.code !== this.$i18n.locale
            );
        },
    },
};
</script>
