<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      fixed
      app
    >
      <v-toolbar color="indigo" dark>
        <v-toolbar-title>グループ一覧</v-toolbar-title>
      </v-toolbar>

      <v-list dense>
        <v-list-tile
          v-for="inventoryGroup in inventoryGroups"
          :key="inventoryGroup.name"
          @click="changeGroup(inventoryGroup.inventory_group_id)"
        >
          <v-list-tile-action>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ inventoryGroup.name }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <v-list-tile
          @click="addInventoryGroupDialog = true"
        >
          <v-list-tile-action>
            <v-icon>add_circle_outline</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>グループを追加</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer" v-if="!isGuest"></v-toolbar-side-icon>
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
    <v-dialog v-model="addInventoryGroupDialog" max-width="500px">
      <v-card>
        <v-card-title>
          グループ追加
        </v-card-title>
        <v-card-text>
          <v-form v-model="valid">
            <v-text-field
              v-model="name"
              :rules="nameRules"
              label="グループ名"
              required
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn
            color="primary"
            flat
            @click="execAdd"
            :disabled="!valid"
            :loading="addButtonLoading"
          >追加</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'
import axios from 'axios'

export default {
  data() {
    return {
      drawer: null,
      addInventoryGroupDialog: false,
      name: '',
      nameRules: [v => !!v || 'グループ名入力は必須です。'],
      valid: false,
      addButtonLoading: false,
    }
  },
  computed: {
    ...mapState(['isGuest', 'inventoryGroups']),
    ...mapGetters({
      csrf: 'getCsrf',
      currentInventoryGroup: 'getCurrentInventoryGroup',
    }),
  },
  methods: {
    logout() {
      this.$refs.logoutForm.submit()
    },
    execAdd() {
      this.addButtonLoading = true
      this.addInventoryGroup(this.name).then(() => {
        this.addButtonLoading = false
        this.addInventoryGroupDialog = false
      })
    },
    changeGroup(id) {
      this.$store.commit('SET_CURRENT_INVENTORY_GROUP_ID', id)
      this.drawer = false
    },
    ...mapActions(['addInventoryGroup']),
  },
}
</script>
