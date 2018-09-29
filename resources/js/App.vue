<template>
  <div>
    <zaikok-header></zaikok-header>
    <div v-if="isGuest">ゲストです</div>
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
