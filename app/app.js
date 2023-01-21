require('./bootstrap');


import VueSweetalert2 from 'vue-sweetalert2';
import Print from 'vue-print-nb';
import VueFilter from 'vue-filter';

Vue.use(VueFilter); 
Vue.use(VueSweetalert2);
Vue.use(Print);
Vue.use(require('vue-moment'));


const Dashboard = Vue.component('Dashboard', require('./components/dashboard.vue'));


const MenuIndex = Vue.component('MenuIndex', require('./components/c_menu/MenuIndex.vue'));
const MenuTambah = Vue.component('MenuTambah', require('./components/c_menu/MenuTambah.vue'));
const MenuDetail = Vue.component('MenuDetail', require('./components/c_menu/MenuDetail.vue'));
const MenuEdit = Vue.component('MenuEdit', require('./components/c_menu/MenuEdit.vue'));

const KategoriMenuIndex = Vue.component('KategoriMenuIndex', require('./components/c_ktmenu/KategoriMenuIndex.vue'));
const KategoriMenuTambah = Vue.component('KategoriMenuTambah', require('./components/c_ktmenu/KategoriMenuTambah.vue'));
const KategoriMenuEdit = Vue.component('KategoriMenuEdit', require('./components/c_ktmenu/KategoriMenuEdit.vue'));


const KategoriPesanIndex = Vue.component('KategoriPesanIndex', require('./components/c_ktpesanan/KategoriPesananIndex.vue'));
const KategoriPesanTambah = Vue.component('KategoriPesanTambah', require('./components/c_ktpesanan/KategoriPesananTambah.vue'));
const KategoriPesanEdit = Vue.component('KategoriPesanEdit', require('./components/c_ktpesanan/KategoriPesananEdit.vue'));

const MejaIndex = Vue.component('MejaIndex', require('./components/c_meja/MejaIndex.vue'));
const MejaTambah = Vue.component('MejaTambah', require('./components/c_meja/MejaTambah.vue'));
const MejaEdit = Vue.component('MejaEdit', require('./components/c_meja/MejaEdit.vue'));

const PembayaranIndex = Vue.component('PembayaranIndex', require('./components/c_pembayaran/PembayaranIndex.vue'));
const PembayaranDetail = Vue.component('PembayaranDetail', require('./components/c_pembayaran/PembayaranDetail.vue'));

const PesananIndex = Vue.component('PesananIndex', require('./components/c_pesanan/PesananIndex.vue'));
const PesananEdit = Vue.component('PesananEdit', require('./components/c_pesanan/PesananEdit.vue'));
const PesananKasir = Vue.component('PesananKasir', require('./components/c_pesanan/PesananKasir.vue'));
const PesananEditKasir = Vue.component('PesananEditKasir', require('./components/c_pesanan/PesananEditKasir.vue'));

const UserIndex = Vue.component('UserIndex', require('./components/c_userakun/UserAkunIndex.vue'));
const UserAkunTambah = Vue.component('UserAkunTambah', require('./components/c_userakun/UserAkunTambah.vue'));
const UserAkunEdit = Vue.component('UserAkunEdit', require('./components/c_userakun/UserAkunEdit.vue'));
const UserAkunDetail = Vue.component('UserAkunDetail', require('./components/c_userakun/UserAkunDetail.vue'));

const routes = [

 
    { path: '/pemesanan', component: Dashboard, name: 'pemesanan' },


    { path: '/manage-menu/', component: MenuIndex, name: 'indexMenu' },
    { path: '/manage-menu/create', component: MenuTambah, name: 'TambahMenu' },
    { path: '/manage-menu/view/:id', component: MenuDetail, name: 'MenuDetail' },
    { path: '/manage-menu/edit/:id', component: MenuEdit, name: 'MenuEdit' },


    { path: '/manage-kategori-menu/', component: KategoriMenuIndex, name: 'indexKategoriMenu' },
    { path: '/manage-kategori-menu/create', component: KategoriMenuTambah, name: 'TambahKategoriMenu' },
    { path: '/manage-kategori-menu/edit/:id', component: KategoriMenuEdit, name: 'KategoriMenuEdit' },

    { path: '/manage-kategori-pesan/', component: KategoriPesanIndex, name: 'indexKategoriPesan' },
    { path: '/manage-kategori-pesan/create', component: KategoriPesanTambah, name: 'TambahKategoriPesan' },
    { path: '/manage-kategori-pesan/edit/:id', component: KategoriPesanEdit, name: 'KategoriPesanEdit' },

    { path: '/manage-meja/', component: MejaIndex, name: 'indexMeja' },
    { path: '/manage-meja/create', component: MejaTambah, name: 'TambahMeja' },
    { path: '/manage-meja/edit/:id', component: MejaEdit, name: 'EditMeja' },

    { path: '/manage-pembayaran/', component: PembayaranIndex, name: 'indexPembayaran' },
    { path: '/manage-pembayaran/view/:id', component: PembayaranDetail, name: 'DetailPembayaran' },

    { path: '/manage-pesanan/', component: PesananIndex, name: 'indexPesanan' },
    { path: '/manage-pesanan/', component: PesananKasir, name: 'indexPesananKasir' },
    { path: '/manage-pesanan/view/:id', component: PesananEdit, name: 'detailPesanan' },
    { path: '/manage-pesanan/view/:id', component: PesananEditKasir, name: 'detailPesananKasir' },

    { path: '/manage-user/', component: UserIndex, name: 'indexUserAkun' },
    { path: '/manage-user/create', component: UserAkunTambah, name: 'tambahUserAkun' },
    { path: '/manage-user/edit/:id', component: UserAkunEdit, name: 'editUserAkun' },
    { path: '/manage-user/view/:id', component: UserAkunDetail, name: 'detailUserAkun' },
]


const router = new VueRouter({ mode: 'history', routes: routes });

new Vue({ router }).$mount('#app');


