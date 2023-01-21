<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">DATA KATEGORI MENU</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-border-primary">
              <thead class="bg-primary">
                <th>NO</th>
                <th>NAMA KATEGORI</th>               
                <th>AKSI</th>
              </thead>
              <tr v-for="(ktmenu, number ) in kategoriMenus" :key="ktmenu.id_ktmenu">
                <td>{{number+1}}</td>
                <td>{{ktmenu.nama_kategori }}</td>
             
                
                <td>
                 
                  <router-link :to="{name: 'KategoriMenuEdit', params: {id: ktmenu.id_ktmenu}}">
                    <i class="fa fa-edit text-primary"></i>
                  </router-link>&nbsp;
                  <a href="#" v-on:click="HapusData(ktmenu.id_ktmenu, number)">
                    <i class="fa fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            <p>
              <router-link :to="{name: 'TambahKategoriMenu'}" class="btn btn-success">Tambah</router-link>
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
      kategoriMenus: []
    };
  },
  mounted() {
    this.ambilData();
  },
  methods: {
    ambilData() {
      axios.get("/kategori-menu").then(response => {
        this.kategoriMenus = response.data;
      });
    },

  

    HapusData(id_ktmenu, number) {
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
          console.log(id_ktmenu);
          console.log(number);
          axios.delete("/kategori-menu/" + id_ktmenu).then(response => {
            this.kategoriMenus.splice(number, 1);
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