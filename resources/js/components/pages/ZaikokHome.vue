<template>
  <v-container grid-list-md>
    <v-layout row wrap>
      <v-flex xs12 text-xs-left>
        <h2>{{ this.userName }} さんの在庫管理</h2>
        <h3>グループ: {{ inventoryGroupName }}</h3>
      </v-flex>
      <v-flex xs12 text-xs-center>
        <v-data-table
          :headers="headers"
          :items="inventories"
          hide-actions
          class="elevation-1"
        >
          <template slot="items" slot-scope="props">
            <td>{{ props.item.inventory_id }}</td>
            <td>{{ props.item.name }}</td>
            <td class="text-xs-right">{{ props.item.count }}</td>
            <td class="text-xs-right">{{ props.item.updated_at }}</td>
            <td class="text-xs-right">{{ props.item.created_at }}</td>
          </template>
          <template slot="no-data">
            <v-alert :value="true" color="error" icon="warning">
              Sorry, nothing to display here :(
            </v-alert>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
    <v-btn fab dark color="red darken-1" class="sticky-button">
      <v-icon dark @click="deleteGroup">close</v-icon>
    </v-btn>
  </v-container>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      headers: [
        { text: 'ID', value: 'inventory_id' },
        { text: '品物', value: 'name' },
        { text: '個数', value: 'count' },
        { text: '更新日時', value: 'updated_at' },
        { text: '追加日', value: 'created_at' },
      ],
    }
  },
  props: {
    token: {
      type: String,
      default: '',
    },
  },
  created() {
    this.$store.commit('SET_TOKEN', this.token)
    this.$store.dispatch('login')
    this.$store.dispatch('setInventory')
    this.setInventoryGroups()
  },
  computed: {
    ...mapState(['user', 'inventories', 'inventoryGroups']),
    ...mapGetters({
      userId: 'getUserId',
      userName: 'getUserName',
      inventoryGroupName: 'getCurrentInventoryGroupName',
      firstInventoryGroupId: 'getFirstInventoryGroupByGroupId',
    }),
  },
  methods: {
    deleteGroup() {
      if (!confirm('グループを削除します。よろしいですか？')) {
        return
      }
      this.deleteInventoryGroup()
    },
    ...mapActions([
      'editInventoryGroup',
      'deleteInventoryGroup',
      'setInventoryGroups',
    ]),
  },
}
</script>

<style scoped>
.sticky-button {
  position: fixed;
  top: 80px;
  right: 20px;
}
</style>
