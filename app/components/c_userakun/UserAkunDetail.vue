<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{userakuns.nama}}</h3>
        </div>
        <table class="table table-bordered" width="80%">
          <tbody>

            <tr>
              <td>ALAMAT</td>
              <td>{{userakuns.alamat}}</td>
            </tr>
            <tr>
              <td>NO TELEPHONE</td>
              <td>{{userakuns.no_tlpn}}</td>
            </tr>
            <tr>
              <td>USERNAME</td>
              <td>{{userakuns.username}}</td>
            </tr>
            <tr>
              <td>PASSWORD</td>
              <td>{{userakuns.password}}</td>
            </tr>
            <tr>
              <td>LEVEL</td>
              <td>
                <span class="label label-warning" v-if="userakuns.level===1">PELAYAN</span>
                <span class="label label-success" v-else-if="userakuns.level===2">DIVISI MAKANAN</span>
                <span class="label label-info" v-else-if="userakuns.level===3">DIVISI MINUMAN</span>
                <span class="label label-primary" v-else-if="userakuns.level===4">KASIR</span>
                <span class="label label-danger" v-else>ADMIN</span>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="box-footer">
          <router-link :to="{name: 'indexUserAkun'}" class="btn btn-primary">Kembali</router-link>
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
    this.userakunsId = id;
    axios.get("/user-akun/" + id).then(response => {
      this.userakuns = response.data;
    });
    
    let md5 = require('md5');
   
  },
  data: function() {
    return {
      userakunsId: null,
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
  }
};
</script>
