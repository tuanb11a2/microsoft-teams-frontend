<template>
    <div class="font-sans leading-normal tracking-normal">
        <nav
            class="bg-purple-900 h-12 pt-2 md:pt-1 pb-1 px-1 mt-0 flex items-center fixed w-full z-20 top-0"
        >
            <nuxt-link to="/" class="text-white ml-4 md:ml-20 text-xl"
                >Microsoft Teams</nuxt-link
            >
        </nav>
        <div class="pt-12 px-4 sm:px-6 lg:px-8 bg-gray-100 h-full min-h-screen">
            <nuxt-img
                class="mx-auto h-24 w-auto"
                src="/images/logo.png"
                alt="Microsoft Teams"
            />
            <h2 class="text-center text-3xl font-extrabold mb-10 text-gray-900">
                <PortalTarget name="pageTitle"></PortalTarget>
            </h2>
            <Nuxt />
        </div>
    </div>
</template>

<script>
export default {};
</script>
