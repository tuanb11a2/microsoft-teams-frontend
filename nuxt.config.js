export default {
    // Global page headers: https://go.nuxtjs.dev/config-head
    head: {
        title: "Teams",
        htmlAttrs: {
            lang: "vi",
        },
        meta: [
            { charset: "utf-8" },
            {
                name: "viewport",
                content: "width=device-width, initial-scale=1",
            },
            { hid: "description", name: "description", content: "" },
            { name: "format-detection", content: "telephone=no" },
        ],
        link: [
            { rel: "icon", type: "image/x-icon", href: "/favicon.ico" },
            {
                rel: "stylesheet",
                href: "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css",
            },
        ],
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: ["@/assets/css/main.css"],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: ["@/plugins/axios", "@/plugins/mask", "@/plugins/vuelidate", "@/plugins/portal-vue"],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        "@nuxtjs/moment",
        "@nuxt/image",
        "@nuxtjs/style-resources",
        "@nuxtjs/google-analytics",
        "@nuxt/postcss8",
        [
            "@nuxtjs/laravel-echo",
            { host: "http://localhost:6001", broadcaster: "socket.io-client" },
        ],
    ],

    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        ["cookie-universal-nuxt", { alias: "cookiz" }],
        "@nuxtjs/axios",
        "@nuxtjs/i18n",
        "@nuxtjs/gtm",
        "@nuxtjs/recaptcha",
        "@nuxtjs/sitemap",
    ],

    recaptcha: {
        hideBadge: true, // Hide badge element (v3 & v2 via size=invisible)
        language: "vi", // Recaptcha language (v2)
        siteKey: process.env.RECAPTCHA_SITE_KEY, // Site key for requests
        version: 2,
    },

    googleAnalytics: {
        id: process.env.GOOGLE_ANALYTICS_ID, // Use as fallback if no runtime config is provided
    },

    gtm: {
        id: "GTM-TZ7XV57",
        enabled: true,
        debug: true,

        layer: "dataLayer",
        variables: {},

        pageTracking: false,
        pageViewEventName: "nuxtRoute",

        autoInit: true,
        respectDoNotTrack: true,

        scriptId: "gtm-script",
        scriptDefer: false,
        scriptURL: "https://www.googletagmanager.com/gtm.js",
        crossOrigin: false,

        noscript: true,
        noscriptId: "gtm-noscript",
        noscriptURL: "https://www.googletagmanager.com/ns.html",
    },
    moment: {
        /* module options */
    },
    i18n: {
        detectBrowserLanguage: {
            useCookie: true,
            cookieKey: "lang",
            alwaysRedirect: true,
            redirectOn: "root", // recommended
        },
        locales: [
            { code: "en", name: "English", iso: "en-US", file: "en.js" },
            { code: "vi", name: "Tiếng Việt", iso: "vi-VN", file: "vi.js" },
        ],
        defaultLocale: "vi",
        vueI18n: {
            fallbackLocale: "vi",
            messages: {
                en: () => import("~/lang/en.js"),
                vi: () => import("~/lang/vi.js"),
            },
        },
        langDir: "~/lang/",
    },
    axios: {
        proxy: true,
        baseURL: process.env.BASE_URL,
    },

    publicRuntimeConfig: {
        axios: {
            browserBaseURL: process.env.BROWSER_BASE_URL,
        },
        recaptcha: {
            /* reCAPTCHA options */
            siteKey: process.env.RECAPTCHA_SITE_KEY, // for example
        },
    },

    privateRuntimeConfig: {
        axios: {
            baseURL: process.env.BASE_URL,
        },
    },

    // Build Configuration: https://go.nuxtjs.dev/config-build
    build: {
        postcss: {
            plugins: {
                tailwindcss: {},
                autoprefixer: {},
            },
        },
    },
};
