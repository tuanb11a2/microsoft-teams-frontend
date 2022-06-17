<template>
    <div class="px-5 sm:px-10 md:px-40 py-2 rounded-md">
        <div class="flex flex-col items-center">
            <h1 class="font-bold mb-10 text-blue-600 text-5xl md:text-9xl">
                403
            </h1>

            <h6
                class="mb-5 text-2xl font-bold text-center text-gray-800 md:text-3xl"
            >
                <span class="text-red-500">Oops!</span>
                Forbidden
            </h6>

            <p class="mb-8 text-center text-gray-500 md:text-lg">
                You don't have access to this resource!
            </p>

            <div class="inline-flex">
                <button
                    @click="$router.go(-1)"
                    class="px-6 py-2 mr-5 rounded font-semibold text-blue-800 bg-blue-100 hover:bg-blue-200"
                >
                    Go back
                </button>
                <button
                    @click="$router.push('/')"
                    class="px-6 py-2 font-semibold rounded bg-blue-500 hover:bg-blue-600 text-white"
                >
                    To home page
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    layout: "guest",
};
</script>
