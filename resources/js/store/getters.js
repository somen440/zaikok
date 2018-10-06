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
}
