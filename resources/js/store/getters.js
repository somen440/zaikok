export default {
  getCsrf: () => {
    return document.head.querySelector('meta[name="csrf-token"]').content
  },

  getUserId: state => {
    return state.user.user_id || null
  },

  getUserName: state => {
    return null === state.user ? '' : state.user.name
  },

  nextInventoryGroupId: state => {
    const length = state.inventoryGroups.length
    if (0 < length) {
      return state.inventoryGroups[length - 1].inventory_group_id + 1
    }
    return 1
  },
}
