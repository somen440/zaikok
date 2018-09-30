export default {
  getCsrf() {
    return document.head.querySelector('meta[name="csrf-token"]').content
  },
}
