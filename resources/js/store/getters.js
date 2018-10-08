export default {
  getCsrf: () => {
    return document.head.querySelector('meta[name="csrf-token"]').content
  },

  getUserId: state => {
    return null === state.user ? null : state.user.user_id
  },

  getUserName: state => {
    return null === state.user ? '' : state.user.name
  },

  nextInventoryGroupId: state => {
    const keys = Object.keys(state.inventoryGroups)
    return 0 < keys.length ? keys[keys.length - 1] + 1 : 1
  },

  getCurrentInventoryGroup: state => {
    return state.inventoryGroups[state.currentInventoryGroupId]
  },

  getCurrentInventoryGroupName: (state, getters) => {
    return undefined === getters.getCurrentInventoryGroup
      ? ''
      : getters.getCurrentInventoryGroup.name
  },

  getCurrentInventoryGroupId: (state, getters) => {
    return undefined === getters.getCurrentInventoryGroup
      ? -1
      : getters.getCurrentInventoryGroup.id
  },

  getFirstInventoryGroup: state => {
    const keys = Object.keys(state.inventoryGroups)
    return 0 < keys.length ? state.inventoryGroups[keys[0]] : null
  },

  getFirstInventoryGroupByGroupId: (state, getters) => {
    return null === getters.getFirstInventoryGroup
      ? -1
      : getters.getFirstInventoryGroup.id
  },
}
