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
                label="Name"
                type="text"
                v-model="name"
                :nameRules="[v => !!v || 'Name is required']"
                required
              ></v-text-field>
              <v-text-field
                prepend-icon="person"
                label="LoginID"
                type="text"
                v-model="email"
                :loginIdRules="[v => !!v || 'LoginID is required']"
                required
              ></v-text-field>
              <v-text-field
                prepend-icon="lock"
                label="Password"
                type="password"
                v-model="password"
                :passwordRules="[v => !!v || 'Password is required']"
                required
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="register" :disabled="!valid">登録</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import * as API from '../../api'

export default {
  data() {
    return {
      valid: false,
      name: '',
      email: '',
      password: '',
    }
  },
  methods: {
    register() {
      if (!this.$refs.form.validate()) {
        return
      }
      API.registerUser({
        name: this.name,
        email: this.email,
        password: this.password,
      })
        .then(response => {
          if (200 === response.status) {
            this.$store
              .dispatch('fetchIsGuest')
              .then(res => this.$router.push('home'))
          }
        })
        .catch(error => {
          alert('登録ずみ')
        })
    },
  },
}
</script>
