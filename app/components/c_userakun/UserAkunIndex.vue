<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">DATA USER SISTEM</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-border-primary">
              <thead class="bg-primary">
                <th>NO</th>
            
                <th>NAMA</th>
                <th>ALAMAT</th>
                <th>NO TLPN</th>
                <th>LEVEL</th>
                <th>AKSI</th>
              </thead>
              <tr v-for="(userakun, number ) in userakuns" :key="userakun.id_user">
                <td>{{number+1}}</td>
          
              
                <td>{{userakun.nama }}</td>
                <td>{{userakun.alamat }}</td>
                <td>{{userakun.no_tlpn }}</td>
                <td>
                  <span class="label label-warning" v-if="userakun.level===1">PELAYAN</span>
                  <span class="label label-success" v-else-if="userakun.level===2">DIVISI MAKANAN</span>
                  <span class="label label-info" v-else-if="userakun.level===3">DIVISI MINUMAN</span>
                  <span class="label label-primary" v-else-if="userakun.level===4">KASIR</span>
                  <span class="label label-danger" v-else>ADMIN</span>

                </td>

                <td>
                  <router-link :to="{name: 'detailUserAkun', params: {id: userakun.id_user}}">
                    <i class="fa fa-eye text-primary"></i>
                  </router-link>&nbsp;
                  <router-link :to="{name: 'editUserAkun', params: {id: userakun.id_user}}">
                    <i class="fa fa-edit text-primary"></i>
                  </router-link>&nbsp;
                  <a href="#" v-on:click="HapusData(userakun.id_user, number)">
                    <i class="fa fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            <p>
              <router-link :to="{name: 'tambahUserAkun'}" class="btn btn-success">Tambah</router-link>
            </p>
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
      userakuns: []
    };
  },
  mounted() {
    this.ambilData();
    
  },
  methods: {
    ambilData() {
      axios.get("/user-akun?sort=nama").then(response => {
        this.userakuns = response.data;
      });
    },

    HapusData(id_user, number) {
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
          axios.delete("/user-akun/" + id_user).then(response => {
            this.userakuns.splice(number, 1);
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