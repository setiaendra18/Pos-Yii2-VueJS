<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{menu.nama}}</h3>
        </div>
        <table class="table table-bordered" width="80%">
          <tbody>

            <tr>
              <td>Kategori Menu</td>
              <td>{{menu.id_ktmenu}}</td>
            </tr>
            <tr>
              <td>Jenis Satuan</td>
              <td>{{menu.satuan}}</td>
            </tr>
            <tr>
              <td>Harga</td>
              <td>Rp. {{formatHarga(menu.harga)}}</td>
            </tr>
            <tr>
              <td>Jumlah Stok</td>
              <td>
                <span v-if="menu.stok!=0">{{menu.stok}}</span>
                <span class="label label-danger" v-else>Stok Habis</span>
              </td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td>{{menu.deskripsi}}</td>
            </tr>
          </tbody>
        </table>
        <div class="box-footer">
          <router-link :to="{name: 'indexMenu'}" class="btn btn-primary">Kembali</router-link>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    let id = this.$route.params.id;
    this.menuId = id;
    axios.get("/menu/" + id).then(response => {
      this.menu = response.data;
    });
  },
  data: function() {
    return {
      menuId: null,
      menu: {
        nama: "",
        id_ktmenu: "",
        satuan: "",
        harga: "",
        stok: "",
        deskripsi: "",
        foto: ""
      }
    };
  },
  methods: {
    formatHarga(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
  }
};
</script>
