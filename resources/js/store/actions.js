import * as API from '../api'

export default {
  login: ({ commit }) => {
    commit('SET_IS_GUEST', false)
  },

  logout: ({ commit }) => {
    commit('SET_IS_GUEST', true)
  },
}
