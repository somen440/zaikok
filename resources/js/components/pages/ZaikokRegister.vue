<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar dark color="info">
            <v-toolbar-title>登録情報</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-text-field
                prepend-icon="person"
                v-model="name"
                :rules="nameRules"
                label="Name"
                required
              ></v-text-field>
              <v-text-field
                prepend-icon="person"
                label="LoginID"
                type="text"
                v-model="email"
                :rules="loginIdRules"
                required
              ></v-text-field>
              <v-text-field
                prepend-icon="lock"
                label="Password"
                type="password"
                v-model="password"
                :rules="passwordRules"
                required
              ></v-text-field>
              <v-text-field
                prepend-icon="lock"
                label="Password Confirmation"
                type="password"
                v-model="passwordConfirmation"
                :rules="passwordConfirmRules"
                required
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="register" :disabled="!valid">登録</v-btn>
            <form ref="registerForm" method="POST" action="register" v-show="false">
              <input type="hidden" name="_token" :value="csrf" />
              <input type="hidden" name="name" :value="sendName" />
              <input type="hidden" name="email" :value="sendEmail" />
              <input type="hidden" name="password" :value="sendPassword" />
              <input type="hidden" name="password_confirmation" :value="sendPasswordConfirmation" />
            </form>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Util from '../../util'
import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      valid: false,
      name: '',
      email: '',
      password: '',
      passwordConfirmation: '',
      nameRules: [v => !!v || 'Name is required'],
      loginIdRules: [v => !!v || 'LoginID is required'],
      passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 6) || 'Password must be more than 6 characters',
      ],
      passwordConfirmRules: [
        v => !!v || 'Password Confirm is required',
        v => v === this.password || 'Password confirm is equal to password',
      ],
    }
  },
  computed: {
    sendName() {
      return this.name
    },
    sendEmail() {
      return this.email
    },
    sendPassword() {
      return this.password
    },
    sendPasswordConfirmation() {
      return this.passwordConfirmation
    },
    registerUrl() {
      return Util.createRoutePath('register')
    },
    ...mapGetters({
      csrf: 'getCsrf',
    }),
  },
  methods: {
    register() {
      this.$refs.registerForm.submit()
    },
  },
}
</script>
