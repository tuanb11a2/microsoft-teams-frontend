<template>
    <div>
        <Portal to="pageTitle">
            Find your account
        </Portal>
    </div>
</template>

<script>
export default {
    head: {
        title: "Password forget",
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
