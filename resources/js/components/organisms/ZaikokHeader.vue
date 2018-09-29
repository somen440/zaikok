<template>
  <v-toolbar color="indigo" dark fixed app>
    <v-toolbar-side-icon></v-toolbar-side-icon>
    <v-toolbar-title>在庫管理 -zaikok-</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
      <v-btn flat @click="transitionLoginPage">Login</v-btn>
      <v-btn flat @click="transitionRegisterPage">Register</v-btn>
    </v-toolbar-items>
  </v-toolbar>
</template>

<script>
export default {
  props: {
    isGuest: {
      type: Boolean,
      default: true,
    },
  },
  methods: {
    transitionLoginPage() {
      this.$router.push('login')
    },
    transitionRegisterPage() {
      this.$router.push('register')
    },
  },
}
</script>

<style scoped>
.title:hover {
  cursor: pointer;
}
</style>
