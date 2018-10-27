<template>
  <v-container grid-list-md>
    <h2>Line からも在庫管理 !!</h2>
    <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1">Name of step 1</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 2" step="2">Name of step 2</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 3" step="3">Name of step 3</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 4" step="4">Name of step 4</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content step="1">
          <v-card>
            <v-card-title>
              <h3 class="headline mb-0">1. Zaikok Bot を友達追加</h3>
            </v-card-title>
            <v-card-text>
              <div class="subheading">QRコードを読み込もう !!</div>
              <v-img src="images/zaikok_qr.png" height="125px" contain></v-img>
            </v-card-text>
          </v-card>

          <v-btn
            color="primary"
            @click="e1 = 2"
          >
            次へ
          </v-btn>
        </v-stepper-content>

        <v-stepper-content step="2">
          <v-card>
            <v-card-title>
              <h3 class="headline mb-0">2. 認証コードを発行</h3>
            </v-card-title>
          </v-card>

          <v-btn
            color="primary"
            dark
            @click="createAndNext"
          >認証用コード発行</v-btn>
          <v-btn
            flat
            @click="e1 = 1"
          >戻る</v-btn>
        </v-stepper-content>

        <v-stepper-content step="3">
          <v-card>
            <v-card-title>
              <h3 class="headline mb-0">3. LINE とアカウントの紐付け</h3>
            </v-card-title>
            <v-card-text>
              <div class="subheading">Zaikok Line Bot に 「 login:{{verifyToken}} 」を呟こう</div>
            </v-card-text>
          </v-card>

          <v-btn
            color="primary"
            dark
            @click="e1++"
          >完了</v-btn>
          <v-btn
            flat
            @click="e1--"
          >戻る</v-btn>
        </v-stepper-content>

        <v-stepper-content step="4">
          <v-card>
            <v-img>
              <v-img
                src="images/zaiko_sabaku.png"
                aspect-ratio="2.75"
              ></v-img>
            </v-img>
            <v-card-text>
              <h3 class="text-xs-center">ありがとう !! 完了です。 ゆっくり在庫さばいていってね !!</h3>
            </v-card-text>
          </v-card>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
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
      e1: 0,
    }
  },
  computed: {
    ...mapState(['lineVerify']),
  },
  methods: {
    ...mapActions(['createLineVerify']),
    createAndNext() {
      this.e1++
      this.createLineVerify()
    },
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
