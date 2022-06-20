export default function ({ $axios, app, redirect }) {
    $axios.onError((error) => {
        if (error.response.status === 500) {
            redirect("/server-error");
        }
        if (error.response.status === 401 && app.router.currentRoute.path !== '/login') {
            app.$cookiz.remove('authToken');
            redirect("/unauthorized");
        }
        if (error.response.status === 403) {
            redirect("/forbidden");
        }
    });

    const token = app.$cookiz.get("authToken");
    const lang = app.$cookiz.get("lang");

    if (token) {
        $axios.setHeader("Authorization", `Bearer ${token}`);
    }

    if (lang) {
        $axios.setHeader("Accept-Language", lang);
    }
}
