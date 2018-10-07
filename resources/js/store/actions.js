import * as API from '../api'

function _GetRequest(url, token) {
  return axios.get(`/api/${url}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  })
}

function _PostRequest(url, token, data) {
  return axios.post(`/api/${url}`, data, {
    headers: {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'application/json',
    },
  })
}

export default {
  login: ({ commit, dispatch }) => {
    commit('SET_IS_GUEST', false)
    dispatch('setUser')
  },

  logout: ({ commit }) => {
    commit('SET_IS_GUEST', true)
  },

  setUser: ({ commit, state }) => {
    _GetRequest('user', state.token).then(({ data }) =>
      commit('SET_USER', data),
    )
  },

  setInventory: ({ commit, state }) => {
    // todo: specified group
    _GetRequest('inventory/1', state.token).then(({ data }) =>
      commit('SET_INVENTORIES', data),
    )
  },

  setInventoryGroups: ({ commit, state }) => {
    return _GetRequest('inventory_group', state.token).then(({ data }) =>
      commit('SET_INVENTORY_GROUPS', data),
    )
  },

  addInventoryGroup: ({ state, getters, dispatch }, name) => {
    const newInventoryGroup = {
      inventory_group_id: getters.nextInventoryGroupId,
      user_id: getters.getUserId,
      name: name,
    }
    return _PostRequest('inventory_group', state.token, newInventoryGroup).then(
      () => {
        return dispatch('setInventoryGroups')
      },
    )
  },
}
