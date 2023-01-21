<template>
  <div> 
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">DATA PESANAN KASIR</h3>
            <h3 class="box-title pull-right">{{tanggal_sekarang | moment("DD/MM/YYYY") }}</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-striped">
              <thead class="bg-primary">
                <th>No.</th>
                <th>ID PESAN</th>
                <th>TANGGAL</th>
                <th>KATEGORI PESAN</th>
                <th>NOMOR MEJA</th>
                <th>PELAYAN</th>
                <th>STATUS</th>
                <th>AKSI</th>
              </thead>
              <tr v-if="!pesanans.length">
                    <td colspan="7">
                      <h4 class="text-center"> -- Belum Ada Data --</h4>
                    </td>
                  </tr>
              
              <tr v-for="(pesanan, number ) in pesanans " :key="pesanan.id_pesan" height="30">
                <td>{{number+1}}</td>
                <td>{{pesanan.id_pesan }}</td>
                <td>{{pesanan.tanggal | moment("DD/MM/YYYY")}}</td>
                <td>{{pesanan.id_ktpesan }}</td>
                <td>
                  <span  v-if="pesanan.id_meja==null">---</span>
                  <span  else>{{pesanan.id_meja}}</span>
                </td>
                <td>{{pesanan.id_user }}</td>
                <td>
                  <span class="label label-danger" v-if="pesanan.status_pesan===1">BARU</span>
                  <span class="label label-success" v-else-if="pesanan.status_pesan===2">SELESAI</span>
                </td>

                <td>
                  <router-link
                    :to="{name: 'detailPesananKasir', params: {id: pesanan.id_pesan,id_user:id_user,level:level}}"
                    
                  ><i class="fa fa-eye text-primary"></i></router-link>
                   <a href="#" v-on:click="HapusData(pesanan.id_pesan, number)">
                    <i class="fa fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            </table>
          </div>

          <div class="box-footer clearfix">
          <button class="btn btn-primary btn-sm" @click="HalamanSebelumnya()">PREV</button> <button class="btn btn-primary btn-sm" @click="HalamanLanjut()">NEXT</button>
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
      pesanans: [],
      id_user: "",
      level: "",
      halaman:1,
      tanggal_sekarang: this.tanggalSekarang()
      
    };
  },
  mounted() {
    let id_user = this.$route.params.id_user;
    let level = this.$route.params.level;

    console.log(level);

    this.id_user = id_user;
    this.level = level;
    this.ambilData();
  },
  computed: {
    filterKategori() {
      return this.detail_pesanans.filter(
        row => row.jenis_menu === this.kategori
      );
    }
  },
  methods: {
    ambilData() {
      axios.get("/pesanan?sort=tanggal&page="+this.halaman).then(response => {
        const pesanan = response.data;
          this.pesanans = pesanan.filter(pesanan =>
            pesanan.tanggal.includes(this.tanggal_sekarang)
          );
      });
    },
    HalamanLanjut()
    {
      this.halaman=this.halaman+1
      this.ambilData()
    },
    HalamanSebelumnya()
    {
      this.halaman=this.halaman-1
      this.ambilData()
    },
     HapusData(id_pesan, number) {
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
          axios.delete("/pesanan/" + id_pesan).then(response => {
            this.pesanans.splice(number, 1);
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
    },
     tanggalSekarang() {
      let tanggal = new Date();
      var dd = tanggal.getDate();

      var mm = tanggal.getMonth() + 1;
      var yyyy = tanggal.getFullYear();
      if (dd < 10) {
        dd = "0" + dd;
      }

      if (mm < 10) {
        mm = "0" + mm;
      }
      tanggal = yyyy + "-" + mm + "-" + dd;

      return tanggal;
    }
  }
};
</script>
