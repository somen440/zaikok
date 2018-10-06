import * as API from '../api'

export default {
  login: ({ commit, dispatch }) => {
    commit('SET_IS_GUEST', false)
    dispatch('setUser')
  },

  logout: ({ commit }) => {
    commit('SET_IS_GUEST', true)
  },

  setUser: ({ commit, state }) => {
    axios
      .get('/api/user', {
        headers: {
          Authorization: `Bearer ${state.token}`,
        },
      })
      .then(({ data }) => commit('SET_USER', data))
  },

  setInventory: ({ commit, state }) => {
    axios
      .get('/api/inventory', {
        headers: {
          Authorization: `Bearer ${state.token}`,
        },
      })
      .then(({ data }) => commit('SET_INVENTORIES', data[1]))
  },
}
