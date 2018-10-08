export default {
  SET_IS_GUEST: (state, is) => {
    state.isGuest = is
  },

  SET_TOKEN: (state, token) => {
    state.token = token
  },

  SET_USER: (state, user) => {
    state.user = user
  },

  SET_INVENTORIES: (state, inventories) => {
    state.inventories = inventories
  },

  SET_INVENTORY_GROUPS: (state, inventoryGroups) => {
    state.inventoryGroups = inventoryGroups
  },

  SET_CURRENT_INVENTORY_GROUP_ID: (state, id) => {
    state.currentInventoryGroupId = id
  },
}
