<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FORM TAMBAH USER SISTEM</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" v-on:submit.prevent="UpdateData()">
          <div class="box-body">
            <div class="form-group">
              <label>ID</label>
              <input type="text" v-model="userakuns.id_user" class="form-control" disabled />
            </div>

            <div class="form-group">
              <label>NAMA</label>
              <input type="text" v-model="userakuns.nama" class="form-control" />
            </div>

            <div class="form-group">
              <label>ALAMAT</label>
              <input type="text" v-model="userakuns.alamat" class="form-control" />
            </div>
            <div class="form-group">
              <label>NO TELEPHONE</label>
              <input type="text" v-model="userakuns.no_tlpn" class="form-control" maxlength="12" />
            </div>
            <div class="form-group">
              <label>USERNAME</label>
              <input type="text" v-model="userakuns.username" class="form-control" />
            </div>
            <div class="form-group">
              <label>PASSWORD</label>
              <input type="password" v-model="userakuns.password" class="form-control" />
            </div>
            <div class="form-group">
              <label>JOB ROLE (LEVEL AKUN)</label>
              <select v-model="userakuns.level" class="form-control" aria-placeholder="adsf">
                <option value disabled hidden>--Pilih Level Akun--</option>
                <option value="1">PELAYAN</option>
                <option value="2">DIVISI MAKANAN</option>
                <option value="3">DIVISI MINUMAN</option>
                <option value="4">KASIR</option>
                <option value="5">ADMINISTRATOR</option>
              </select>
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
    axios.get("/user-akun/" + id).then(response => {
      this.userakuns = response.data;
    });
  },
  data: function() {
    return {
      menuId: null,
      userakuns: {
        id_user: "",
        nama: "",
        alamat: "",
        no_tlpn: "",
        username: "",
        password: "",
        level: "",
        foto: ""
      }
    };
  },
  methods: {
    UpdateData() {
      let md5 = require("md5");

      axios
        .patch("/user-akun/" + this.menuId, {
          id_user: this.userakuns.id_user,
          nama: this.userakuns.nama,
          alamat: this.userakuns.alamat,
          no_tlpn: this.userakuns.no_tlpn,
          username: this.userakuns.username,
          password: md5(this.userakuns.password),
          level: this.userakuns.level,
          foto: this.userakuns.foto
        })
        .then(response => {
          this.UpdateBerhasil();
          this.$router.push({ name: "indexUserAkun" });
        });
    },
    UpdateBerhasil() {
      // $swal function calls SweetAlert into the application with the specified configuration.
      this.$swal("Sukses!", "Data Berhasil Di Update!", "success");
    }
  }
};
</script>
