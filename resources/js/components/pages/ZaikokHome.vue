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
export default {
  created() {
    this.$store.dispatch('login')
  },
}
</script>
