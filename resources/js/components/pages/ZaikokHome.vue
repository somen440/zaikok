<template>
  <router-view></router-view>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  props: {
    token: {
      type: String,
      default: '',
    },
  },
  created() {
    this.$store.commit('SET_TOKEN', this.token)
    this.$store.dispatch('login')
    this.setInventoryGroups()
    this.$router.push('/home/1')
  },
  methods: {
    ...mapActions(['setInventoryGroups']),
  },
}
</script>
