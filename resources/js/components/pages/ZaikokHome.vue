<template>
  <v-container fluid fill-height>
    <v-layout
      justify-center
      align-center
    >
      home
    </v-layout>
  </v-container>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
  created() {
    this.$store.dispatch('login')
  },
  props: {
    token: {
      type: String,
      default: '',
    },
  },
  created() {
    this.$store.commit('SET_TOKEN', this.token)
    this.$store.dispatch('setUser')
    this.$store.dispatch('setInventory')
  },
  computed: {
    ...mapState(['user']),
    ...mapGetters({
      userId: 'getUserId',
      userName: 'getUserName',
    }),
  },
}
</script>
