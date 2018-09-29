import * as API from '../api'

export default {
  fetchIsGuest: ({ commit }) => {
    API.isGuest().then(({ data }) => commit('SET_IS_GUEST', data))
  },
}
