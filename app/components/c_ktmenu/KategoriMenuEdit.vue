<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FORM EDIT KATEGORI MENU</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" v-on:submit.prevent="UpdateData()">
          <div class="box-body">
            <div class="form-group">
              <label>ID-KATEGORI</label>
              <input type="text" v-model="kategoriMenu.id_ktmenu" class="form-control" disabled>
            </div>
            <div class="form-group">
              <label>NAMA KATEGORI</label>
              <input type="text" v-model="kategoriMenu.nama_kategori" class="form-control" maxlength="15">
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-warning">Simpan</button>
          </div>
        </form>
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
    axios.get("/kategori-menu/" + id).then(response => {
      this.kategoriMenu = response.data;
    });
  },
  data: function() {
    return {
      menuId: null,
      kategoriMenu: {
        id_ktmenu: "",
        nama_kategori: ""
      }
    };
  },
  methods: {
    UpdateData() {
      axios.patch("/kategori-menu/" + this.menuId, this.kategoriMenu).then(response => {
        this.UpdateBerhasil();
        this.$router.push({ name: "indexKategoriMenu" });
      });
    },
    UpdateBerhasil() {
      // $swal function calls SweetAlert into the application with the specified configuration.
      this.$swal("Sukses!", "Data Berhasil Di Update!", "success");
    }
  }
};
</script>
