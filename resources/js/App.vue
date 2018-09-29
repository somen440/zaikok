<template>
  <div>
    <zaikok-header
      :isGuest="isGuest"
    ></zaikok-header>
    <v-content>
      <v-container fluid>
        <div v-if="isGuest">ゲストです</div>
        <router-view></router-view>
      </v-container>
    </v-content>
  </div>
</template>

<script>
import * as Api from './api'

export default {
  data() {
    return {
      isGuest: true,
    }
  },
  created() {
    Api.isGuest().then(({ data }) => (this.isGuest = data))
  },
}
</script>
