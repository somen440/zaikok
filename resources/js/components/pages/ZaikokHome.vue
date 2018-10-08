<template>
  <v-container grid-list-md>
    <v-layout row wrap>
      <v-flex xs12 text-xs-left>
        <h2>{{ this.userName }} さんの在庫管理</h2>
      </v-flex>
      <v-flex xs12 text-xs-center>
        <v-toolbar flat color="white">
          <v-toolbar-title>
            <h3 v-if="showGroupEditForm">
              <v-form v-model="editInventoryGroupValid" lazy-validation>
                <v-text-field
                  v-model="editInventoryGroupName"
                  :rules="editInventoryGroupNameRules"
                  label="グループ名"
                  required
                  @change="changeInventoryGroupName"
                ></v-text-field>
              </v-form>
            </h3>
            <h3 v-else @click="showGroupEditForm=true">グループ: {{ inventoryGroupName }}</h3>
          </v-toolbar-title>
          <v-divider
            class="mx-2"
            inset
            vertical
          ></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="addInventoryDialog" max-width="500px">
            <v-btn slot="activator" color="primary" dark class="mb-2">新しい品物を追加</v-btn>
            <v-card>
              <v-card-title>
                <span class="headline">新しい品物の情報</span>
              </v-card-title>

              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12>
                      <v-form v-model="addInventoryValid" lazy-validation>
                        <v-text-field
                          v-model="newInventory.name"
                          label="品物名"
                          :rules="addInventoryRules"
                        ></v-text-field>
                      </v-form>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  flat
                  @click.native="saveInventory"
                  :disabled="!addInventoryValid"
                  :loading="addButtonLoading"
                >追加</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
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
      showGroupEditForm: false,
      editInventoryGroupName: '',
      editInventoryGroupNameRules: [v => !!v || '名前の入力は必須です'],
      editInventoryGroupValid: false,
      newInventory: {
        inventory_id: this.addInventoryId,
        inventory_group_id: this.currentGroupId,
        user_id: this.userId,
        name: '',
        count: 0,
      },
      addInventoryDialog: false,
      addInventoryValid: false,
      addInventoryRules: [v => !!v || '名前の入力は必須です'],
      addButtonLoading: false,
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
    this.setInventoryGroups()
  },
  computed: {
    ...mapState(['user', 'inventories', 'inventoryGroups']),
    ...mapGetters({
      userId: 'getUserId',
      userName: 'getUserName',
      inventoryGroupName: 'getCurrentInventoryGroupName',
      firstInventoryGroupId: 'getFirstInventoryGroupByGroupId',
      currentGroupId: 'getCurrentInventoryGroupId',
      nextInventoryId: 'nextInventoryId',
    }),
  },
  watch: {
    inventoryGroupName() {
      this.editInventoryGroupName = this.inventoryGroupName
    },
    currentGroupId() {
      this.newInventory.inventory_group_id = this.currentGroupId
    },
    userId() {
      this.newInventory.user_id = this.userId
    },
  },
  methods: {
    deleteGroup() {
      if (!confirm('グループを削除します。よろしいですか？')) {
        return
      }
      this.deleteInventoryGroup()
    },
    changeInventoryGroupName() {
      if (!this.editInventoryGroupValid) {
        return
      }
      this.showGroupEditForm = false
      this.editInventoryGroup({
        id: this.currentGroupId,
        name: this.editInventoryGroupName,
      })
    },
    saveInventory() {
      this.addButtonLoading = true
      this.newInventory.inventory_id = this.nextInventoryId
      this.addInventory(this.newInventory).then(() => {
        this.addButtonLoading = false
        this.addInventoryDialog = false
      })
    },
    ...mapActions([
      'editInventoryGroup',
      'deleteInventoryGroup',
      'setInventoryGroups',
      'addInventory',
      'setInventory',
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
