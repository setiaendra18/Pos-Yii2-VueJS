<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FORM EDIT MEJA</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" v-on:submit.prevent="UpdateData()">
          <div class="box-body">
            <div class="form-group">
              <label>KODE MEJA</label>
              <input type="text" v-model="mejas.id_meja" class="form-control" disabled>
            </div>
            <div class="form-group">
              <label>NOMOR MEJA</label>
              <input type="number" v-model="mejas.nomor_meja" class="form-control" maxlength="15">
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
    axios.get("/meja/" + id).then(response => {
      this.mejas = response.data;
    });
  },
  data: function() {
    return {
      menuId: null,
      mejas: {
        id_meja: "",
        nomor_meja: "",
        
      }
    };
  },
  methods: {
    UpdateData() {
      axios.patch("/meja/" + this.menuId, this.mejas).then(response => {
        this.UpdateBerhasil();
        this.$router.push({ name: "indexMeja" });
      });
    },
    UpdateBerhasil() {
      // $swal function calls SweetAlert into the application with the specified configuration.
      this.$swal("Sukses!", "Data Berhasil Di Update!", "success");
    }
  }
};
</script>
