import { cookieFromRequest } from '~/utils'

export const actions = {
  async nuxtServerInit ({ commit, dispatch }, { req }) {
    const token = cookieFromRequest(req, 'authToken')
    if (token) {
      commit('auth/SET_AUTH_TOKEN', token)
      this.$axios.defaults.headers.common.Authorization = `Bearer ${token}`
      const res = await this.$axios.get("/auth/user");
      commit('auth/FETCH_USER_SUCCESS', res.data)
    }
  },

}