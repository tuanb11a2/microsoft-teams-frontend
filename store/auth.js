// state
export const state = () => ({
    user: null,
    authToken: null,
    forgotPasswordUser: null,
});

// getters
export const getters = {
    user: (state) => state.user,
    authToken: (state) => state.authToken,
    check: (state) => state.user !== null,
};

// mutations
export const mutations = {
    SET_AUTH_TOKEN(state, authToken) {
        state.authToken = authToken;
    },

    FETCH_USER_SUCCESS(state, user) {
        state.user = user;
    },

    FETCH_USER_FAILURE(state) {
        state.authToken = null;
    },

    LOGOUT(state) {
        state.user = null;
        state.authToken = null;
    },

    UPDATE_USER(state, { user }) {
        state.user = user;
    },

    SET_FORGOT_PASSWORD_USER(state, user) {
        state.forgotPasswordUser = user;
    }



};

// actions
export const actions = {
    saveAuthToken({ commit, dispatch }, { authToken, remember }) {
        commit("SET_AUTH_TOKEN", authToken);
        if (!remember) {
            this.$cookiz.set("authToken", authToken)
        } else {
            this.$cookiz.set("authToken", authToken, { maxAge: 60 * 60 * 24 * 7 });
        }
        this.$axios.defaults.headers.common = {
            Authorization: `bearer ${authToken}`,
        };
    },

    async fetchUser({ commit }) {
        try {
            const { data } = await this.$axios.get("/auth/user");
            commit("FETCH_USER_SUCCESS", data);
        } catch (e) {
            this.$cookiz.remove("authToken");

            commit("FETCH_USER_FAILURE");
        }
    },

    updateUser({ commit }, payload) {
        commit("UPDATE_USER", payload);
    },

    async logout({ commit }) {
        try {
            await this.$axios.post("/auth/logout");
        } catch (e) {}

        this.$cookiz.remove("authToken");
        commit("LOGOUT");
        this.$router.push("/login");
    },
};
