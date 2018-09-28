<!DOCTYPE html>
<html>
<head>
    <title>在庫管理 -Zaikok-</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <v-app light>
        <v-toolbar class="white">
            <v-toolbar-title v-text="title"></v-toolbar-title>
        </v-toolbar>
        <v-content>
            <section>
                <v-parallax src="{{ asset('images/hero.jpeg') }}" height="600">
                    <v-layout
                            column
                            align-center
                            justify-center
                            class="white--text"
                    >
                        <img src="{{ asset('images/vuetify.png') }}" alt="Vuetify.js" height="200">
                        <h1 class="white--text mb-2 display-1 text-xs-center">在庫管理 -zaikok-</h1>
                        <div class="subheading mb-3 text-xs-center">Powered by ya-sato@mentol</div>
                        <v-btn
                                class="blue lighten-2 mt-5"
                                dark
                                large
                                href="/register"
                        >
                            はじめる
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-layout
                        column
                        wrap
                        class="my-5"
                        align-center
                >
                    <v-flex xs12 sm4 class="my-3">
                        <div class="text-xs-center">
                            <h2 class="headline">在庫を管理する最善の方法</h2>
                            <span class="subheading">
                                あなたの手で在庫管理が加速します
                            </span>
                        </div>
                    </v-flex>
                    <v-flex xs12>
                        <v-container grid-list-xl>
                            <v-layout row wrap align-center>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">color_lens</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">スピーディな在庫管理</div>
                                        </v-card-title>
                                        <v-card-text>
                                            すぐにオンラインで在庫管理ができるZaikok。
                                            難しい操作は必要ありません。
                                            最新のWeb技術の活用で驚くほど簡単に、
                                            時間とコストをかけることなく在庫管理を行えます。
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">flash_on</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline">リーズナブルな費用</div>
                                        </v-card-title>
                                        <v-card-text>
                                            サービス利用はフリーです。
                                            全てフリー、責任もフリーです。
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">build</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">オープンソースでいつでも要望、開発も</div>
                                        </v-card-title>
                                        <v-card-text>
                                            全てはオープンソースに始まります。
                                            経験欠乏な担当者のレポジトリにアクセスし要望を送りましょう。
                                            答えるかはわかりません。
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section>
                <v-parallax src="{{ asset('images/section.jpg') }}" height="380">
                    <v-layout column align-center justify-center>
                        <div class="headline white--text mb-3 text-xs-center">在庫管理ってこんな簡単だったんだ</div>
                        <em>今日からWebで在庫管理を始められます</em>
                        <v-btn
                                class="blue lighten-2 mt-5"
                                dark
                                large
                                href="/register"
                        >
                            はじめる
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">作った人情報</div>
                                </v-card-title>
                                <v-card-text>
                                    適当な日々をのんのんと生きてるプログラマーです。
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">コンタクトを取る</div>
                                </v-card-title>
                                <v-card-text>
                                    もし興味を持ったなら続きは web で
                                </v-card-text>
                                <v-list class="transparent">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>012-345-6789</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Japan, JP</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">email</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>mentol310@gmail.com</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>

            <v-footer class="blue darken-2">
                <v-layout row wrap align-center>
                    <v-flex xs12>
                        <div class="white--text ml-3">
                            Made with
                            <v-icon class="red--text">favorite</v-icon>
                            by <a class="white--text" href="https://github.com/mentol0126" target="_blank">ya-sato@mentl</a>
                        </div>
                    </v-flex>
                </v-layout>
            </v-footer>
        </v-content>
    </v-app>
</div>
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
<script>
  new Vue({
    el: '#app',
    data () {
      return {
        title: '在庫管理 -Zaikok-'
      }
    }
  })
</script>
</body>
</html>