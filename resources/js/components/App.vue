<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      fixed
      app
    >
      <v-list dense>
        <v-list-tile>
          <v-list-tile-action>
            <v-icon>home</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Home</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer" v-if="isGuest"></v-toolbar-side-icon>
      <v-toolbar-title>在庫管理　-zaikok-</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items v-if="isGuest">
        <v-btn flat href="login">Login</v-btn>
        <v-btn flat href="register">Register</v-btn>
      </v-toolbar-items>
      <v-toolbar-items v-else>
        <v-btn flat @click="logout">
          Logout
        </v-btn>
        <form ref="logoutForm" action="logout" method="POST" v-show="false">
          <input type="hidden" name="_token" :value="csrf">
        </form>
      </v-toolbar-items>
    </v-toolbar>
    <v-content>
      <slot></slot>
    </v-content>
  </v-app>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import axios from 'axios'

export default {
  data() {
    return {
      drawer: null,
    }
  },
  created() {},
  computed: {
    ...mapState(['isGuest']),
    ...mapGetters({
      csrf: 'getCsrf',
    }),
  },
  methods: {
    logout() {
      this.$refs.logoutForm.submit()
    },
  },
}
</script>
