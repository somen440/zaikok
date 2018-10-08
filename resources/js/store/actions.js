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

function _PutRequest(url, token, data) {
  return axios.put(`/api/${url}`, data, {
    headers: {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'application/json',
    },
  })
}

function _DeleteRequest(url, token) {
  return axios.delete(`/api/${url}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  })
}

export default {
  /**
   * User
   */
  login: ({ commit, dispatch }) => {
    commit('SET_IS_GUEST', false)
    dispatch('setUser')
  },

  logout: ({ commit }) => {
    commit('SET_IS_GUEST', true)
    commit('SET_USER', null)
  },

  setUser: ({ commit, state }) => {
    _GetRequest('user', state.token).then(({ data }) =>
      commit('SET_USER', data),
    )
  },

  /**
   * Inventory
   */
  setInventory: ({ commit, state, getters }) => {
    const groupId = getters.getCurrentInventoryGroupId
    if (-1 === groupId) {
      return Promise.resolve()
    }
    return _GetRequest(`inventory/${groupId}`, state.token).then(({ data }) =>
      commit('SET_INVENTORIES', data),
    )
  },

  addInventory: ({ state, dispatch }, inventory) => {
    return _PostRequest('inventory', state.token, inventory).then(() => {
      return dispatch('setInventory')
    })
  },

  /**
   * Inventory Group
   */
  setInventoryGroups: ({ commit, state, getters, dispatch }) => {
    return _GetRequest('inventory_group', state.token).then(({ data }) => {
      commit('SET_INVENTORY_GROUPS', data)

      if (undefined === getters.getCurrentInventoryGroup) {
        commit(
          'SET_CURRENT_INVENTORY_GROUP_ID',
          getters.getFirstInventoryGroupByGroupId,
        )
        return dispatch('setInventory')
      }
    })
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

  editInventoryGroup: ({ state, dispatch }, group) => {
    return _PutRequest(`inventory_group/${group.id}`, state.token, {
      name: group.name,
    }).then(() => {
      return dispatch('setInventoryGroups')
    })
  },

  deleteInventoryGroup: ({ state, dispatch, getters }) => {
    return _DeleteRequest(
      `inventory_group/${getters.getCurrentInventoryGroupId}`,
      state.token,
    ).then(() => {
      alert('削除が完了しました')
      return dispatch('setInventoryGroups')
    })
  },
}
