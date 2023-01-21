<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">DATA MENU & STOK</h3>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <thead class="bg-primary">
                <th>No.</th>
                <th>NAMA MENU</th>
                <th>KATEGORI MENU</th>
                <th>SATUAN</th>
                <th>HARGA</th>
                <th>STOK</th>
                <th>AKSI</th>
              </thead>
              <tr v-for="(menu, number ) in menus" :key="menu.id_menu" height="30">
                <td>{{number+1}}</td>
                <td>{{menu.nama}}</td>
                <td>{{menu.id_ktmenu}}</td>
                <td>{{menu.satuan}}</td>
                <td>Rp. {{formatHarga(menu.harga)}}</td>
                <td>
                  <span v-if="menu.stok!=0">{{menu.stok}}</span>
                  <span class="label label-danger" v-else>Stok Habis</span>
                </td>

                <td>
                  <router-link :to="{name: 'MenuDetail', params: {id: menu.id_menu}}">
                    <i class="fa fa-eye text-primary"></i>
                  </router-link>&nbsp;
                  <router-link :to="{name: 'MenuEdit', params: {id: menu.id_menu}}">
                    <i class="fa fa-edit text-warning"></i>
                  </router-link>&nbsp;
                  <a href="#" v-on:click="HapusData(menu.id_menu, number)">
                    <i class="fa fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            <router-link :to="{name: 'TambahMenu'}" class="btn btn-success">Tambah</router-link>
            <button
              type="button"
              class="btn btn-info"
              data-toggle="modal"
              data-target="#exampleModal1"
            >CETAK</button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="exampleModal1"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center" id="exampleModalLabel">CETAK</h4>
          </div>
          <div class="modal-body" id="printMe">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#tab_1" data-toggle="tab">DATA STOK</a>
                </li>
                <li>
                  <a href="#tab_2" data-toggle="tab">DATA MENU TERJUAL</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <h4>DATA KETERSEDIAAN MENU {{ new Date() | moment("DD/MM/YYYY")}}</h4>
                  <table class="table table-bordered" id="printMe">
                    <thead class="bg-primary">
                      <th>No.</th>
                      <th>NAMA MENU</th>
                      <th>SISA STOK</th>
                    </thead>
                    <tr v-if="!menus.length">
                      <td colspan="7">
                        <h4 class="text-center">-- Belum Ada Data --</h4>
                      </td>
                    </tr>
                    <tr v-for="(menu, number ) in menus" :key="menu.id_nota" height="30">
                      <td>{{number+1}}</td>
                      <td>{{menu.nama}}</td>
                      <td>
                        <span v-if="menu.stok!=0">{{menu.stok}}</span>
                        <span class="label label-danger" v-else>Stok Habis</span>
                      </td>
                    </tr>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <h4>DATA MENU TERJUAL {{ new Date() | moment("DD/MM/YYYY")}}</h4>
                  <table class="table table-bordered" id="printMe">
                    <thead class="bg-primary">
                      <th>No.</th>
                      <th>NAMA MENU</th>
                      <th>JUMLAH TERJUAL</th>
                    </thead>
                    <tr v-if="!menu_terjual.length">
                      <td colspan="7">
                        <h4 class="text-center">-- Belum Ada Data --</h4>
                      </td>
                    </tr>
                    <tr v-for="(menu, number ) in menu_terjual" :key="menu.id_nota" height="30">
                      <td>{{number+1}}</td>
                      <td>{{menu.nama}}</td>
                      <td>{{menu.jumlah}}</td>
                    </tr>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" v-print="'#printMe'">
              <i class="fa fa-print"></i>
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      menus: [],
      menu_terjual: []
    };
  },
  mounted() {
    this.ambilData();
    this.MenuTerjual();
  },
  methods: {
    ambilData() {
      axios.get("/menu?sort=nama").then(response => {
        this.menus = response.data;
      });
    },
    MenuTerjual() {
      axios.get("/menu-terjual").then(response => {
        this.menu_terjual = response.data;
      });
    },

    formatHarga(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    HapusData(id_menu, number) {
      this.$swal({
        title: "Apakah Anda Yakin?",
        text: "Anda tidak bisa mengembalikan data",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus Data",
        cancelButtonText: "Tidak, Tetap Simpan",
        showCloseButton: true,
        showLoaderOnConfirm: true
      }).then(result => {
        if (result.value) {
          console.log(id_menu);
          console.log(number);
          axios.delete("/menu/" + id_menu).then(response => {
            this.menus.splice(number, 1);
          });
          this.$swal(
            "Data , Sukses Di Hapus",
            "Anda telah menghapus data tersebut",
            "success"
          );
        } else {
          this.$swal("Di batalkan", "anda tidak menghapus data", "info");
        }
      });
    }
  }
};
</script>