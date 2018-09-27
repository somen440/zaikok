<template>
  <div>
    <zaikok-header></zaikok-header>
    <zaikok-sidebar></zaikok-sidebar>
  </div>
</template>

<script>
import { ZaikokHeader, ZaikokSidebar } from './components'

export default {
  mounted() {
    console.log('Component mounted.')
  },
  components: {
    ZaikokHeader,
    ZaikokSidebar,
  },
}
</script>
