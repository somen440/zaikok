<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar dark color="info">
            <v-toolbar-title>Login form</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field prepend-icon="person" label="Login ID" type="text" v-model="loginId"></v-text-field>
              <v-text-field prepend-icon="lock" label="Password" type="password" v-model="password"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="login">Login</v-btn>
            <form ref="loginForm" method="POST" action="login" v-show="false">
              <input type="hidden" name="_token" :value="csrf" />
              <input type="hidden" name="email" :value="sendLoginId" />
              <input type="hidden" name="password" :value="sendPassword" />>
            </form>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      loginId: '',
      password: '',
    }
  },
  computed: {
    sendLoginId() {
      return this.loginId
    },
    sendPassword() {
      return this.password
    },
    ...mapGetters({
      csrf: 'getCsrf',
    }),
  },
  methods: {
    login() {
      this.$refs.loginForm.submit()
    },
  },
}
</script>
