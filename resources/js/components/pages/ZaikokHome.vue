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
  mounted() {
    console.log(this.$store)
    this.$store.dispatch('login')
  },
}
</script>
