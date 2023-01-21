<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">DATA KATEGORI PEMESANAN</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-border-primary">
              <thead class="bg-primary">
                <th>NO</th>

                <th>NAMA KATEGORI</th>               
                <th>AKSI</th>
              </thead>
              <tr v-for="(ktpesan, number ) in kategoriPesans" :key="ktpesan.id_ktpesan">
                <td>{{number+1}}</td>
                <td>{{ktpesan.nama_kategori }}</td>
             
                
                <td>
                
                  <router-link :to="{name: 'KategoriPesanEdit', params: {id: ktpesan.id_ktpesan}}">
                    <i class="fa fa-edit text-primary"></i>
                  </router-link>&nbsp;
                  <a href="#" v-on:click="HapusData(ktpesan.id_ktpesan, number)">
                    <i class="fa fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            <p>
              <router-link :to="{name: 'TambahKategoriPesan'}" class="btn btn-success">Tambah</router-link>
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
      kategoriPesans: []
    };
  },
  mounted() {
    this.ambilData();
  },
  methods: {
    ambilData() {
      console.log(this.kategoriPesans)
      axios.get("/kategori-pesan").then(response => {
        
        this.kategoriPesans = response.data;
        console.log(this.kategoriPesans)
      });
    },

  

    HapusData(id_ktpesan, number) {
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
     
          axios.delete("/kategori-pesan/" + id_ktpesan).then(response => {
            this.kategoriPesans.splice(number, 1);
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