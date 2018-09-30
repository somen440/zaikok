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
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>在庫管理　-zaikok-</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <v-btn flat>
          <router-link to="/login" tag="span">Login</router-link>
        </v-btn>
        <v-btn flat>
          <router-link to="/register" tag="span">Register</router-link>
        </v-btn>
      </v-toolbar-items>
    </v-toolbar>
    <v-content>
      <slot></slot>
    </v-content>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: null,
    }
  },
}
</script>
