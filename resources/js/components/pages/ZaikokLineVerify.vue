<template>
  <v-container grid-list-md>
    <v-layout row　wrap>
      <v-flex xs12>
        <h3 class="headline mb-0">LINEアプリへのQRコード</h3>
        <v-layout column>
          <div class="subheading">QRコード読み込みでLINEに追加できます</div>
          <v-img src="images/zaikok_qr.png" height="125px" contain></v-img>
        </v-layout>
      </v-flex>

      <v-flex xs12>
        <h3 class="headline mb-0">認証コード</h3>
      </v-flex>
      <v-flex xs3>
        <v-text-field
          :value="one"
          outline
          readonly
          text-center
        ></v-text-field>
      </v-flex>
      <v-flex xs3>
        <v-text-field
          :value="two"
          outline
          readonly
        ></v-text-field>
      </v-flex>
      <v-flex xs3>
        <v-text-field
          :value="three"
          outline
          readonly
        ></v-text-field>
      </v-flex>
      <v-flex xs3>
        <v-text-field
          :value="four"
          outline
          readonly
        ></v-text-field>
      </v-flex>

      <v-flex offset-xs9 xs3>
        <v-btn
          color="primary"
          dark
          @click="createLineVerify"
        >認証用コード発行</v-btn>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      one: '',
      two: '',
      three: '',
      four: '',
    }
  },
  computed: {
    ...mapState(['lineVerify']),
  },
  methods: {
    ...mapActions(['createLineVerify']),
  },
  watch: {
    lineVerify() {
      this.one = this.lineVerify[0]
      this.two = this.lineVerify[1]
      this.three = this.lineVerify[2]
      this.four = this.lineVerify[3]
    },
  },
}
</script>
