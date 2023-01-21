window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.VueAxios = require('vue-axios').default;

window.axios = require('axios').default;

Vue.use(VueRouter, VueAxios, axios);


/**
 * Kami akan memuat perpustakaan HTTP axios yang memungkinkan kami untuk dengan mudah mengeluarkan permintaan
 * ke back-end Laravel kami. Perpustakaan ini secara otomatis menangani pengiriman file
 * CSRF token sebagai header berdasarkan nilai cookie token "XSRF".
 */

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/*
 * Selanjutnya kita akan mendaftarkan Token CSRF sebagai header umum dengan Axios sehingga
 * semua permintaan HTTP keluar secara otomatis melampirkannya. Ini hanya
 * kenyamanan sederhana sehingga kami tidak harus melampirkan setiap token secara manual.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found');
}
