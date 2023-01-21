<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">DATA PEMBAYARAN</h3>

            <h3 class="box-title pull-right">{{tanggal_sekarang | moment("DD/MM/YYYY") }}</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-border-primary">
              <thead class="bg-primary">
                <th>No.</th>
                <th>NO NOTA</th>
                <th>KODE PESANAN</th>
                <th>TANGGAL BAYAR</th>
                <th>TOTAL BAYAR</th>
                <th>STATUS BAYAR</th>
                <th>AKSI</th>
              </thead>
              <tr v-if="!pembayarans.length">
                <td colspan="7">
                  <h4 class="text-center">-- Belum Ada Data --</h4>
                </td>
              </tr>
              <tr
                v-for="(pembayaran, number ) in pembayarans"
                :key="pembayaran.id_nota"
                height="30"
              >
                <td>{{number+1}}</td>
                <td>{{pembayaran.no_nota}}</td>
                <td>{{pembayaran.id_pesan }}</td>
                <td>{{pembayaran.tanggal | moment("DD/MM/YYYY")}}</td>
                <td>Rp. {{formatHarga(pembayaran.total_bayar)}}</td>
                <td>
                  <span class="label label-success" v-if="pembayaran.status_bayar==1">LUNAS</span>
                </td>
                <td>
                  <router-link
                    :to="{name: 'DetailPembayaran', params: {id: pembayaran.id_pesan}}"
                    class="btn btn-primary btn-xs btn-flat"
                  >
                    <i class="fa fa-eye"></i>
                  </router-link>&nbsp;
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <strong>Rp. {{formatHarga(total_hasil)}}</strong>
                </td>
                <td></td>
                <td></td>
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            <button class="btn btn-primary btn-sm" @click="HalamanSebelumnya()">PREV</button>
            <button class="btn btn-primary btn-sm" @click="HalamanLanjut()">NEXT</button>
            <button
              type="button"
              class="btn btn-info btn-sm"
              data-toggle="modal"
              data-target="#exampleModal1"
            >CETAK</button>

            <button
              type="button"
              class="btn btn-orange btn-sm pull-right"
              data-toggle="modal"
              data-target="#exampleModal2"
            >SEMUA DATA PEMBAYARAN</button>
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
            <table class="table table-bordered border-primary" id="printMe">
              <thead class="bg-primary">
                <th>No.</th>
                <th>NO NOTA</th>
                <th>KODE PESANAN</th>
                <th>TANGGAL BAYAR</th>
                <th>TOTAL BAYAR</th>
              </thead>
              <tr v-if="!pembayarans.length">
                <td colspan="7">
                  <h4 class="text-center">-- Belum Ada Data --</h4>
                </td>
              </tr>
              <tr
                v-for="(pembayaran, number ) in pembayarans"
                :key="pembayaran.id_nota"
                height="30"
              >
                <td>{{number+1}}</td>
                <td>{{pembayaran.no_nota}}</td>
                <td>{{pembayaran.id_pesan }}</td>
                <td>{{pembayaran.tanggal | moment("DD/MM/YYYY")}}</td>
                <td>Rp. {{formatHarga(pembayaran.total_bayar)}}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <strong>Rp. {{formatHarga(total_hasil)}}</strong>
                </td>
              </tr>
            </table>
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

    <div
      class="modal fade"
      id="exampleModal2"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center" id="exampleModalLabel">DATA PEMBAYARAN</h4>
          </div>
          <div class="modal-body" id="printMe">
            <table class="table table-bordered border-primary" id="printMe2">
              <thead class="bg-primary">
                <th>No.</th>
                <th>NO NOTA</th>
                <th>KODE PESANAN</th>
                <th>TANGGAL BAYAR</th>
                <th>TOTAL BAYAR</th>
              </thead>
              <tr v-if="!semua_pembayaran.length">
                <td colspan="7">
                  <h4 class="text-center">-- Belum Ada Data --</h4>
                </td>
              </tr>
              <tr
                v-for="(pembayaran, number ) in semua_pembayaran"
                :key="pembayaran.id_nota"
                height="30"
              >
                <td>{{number+1}}</td>
                <td>{{pembayaran.no_nota}}</td>
                <td>{{pembayaran.id_pesan }}</td>
                <td>{{pembayaran.tanggal | moment("DD/MM/YYYY")}}</td>
                <td>Rp. {{formatHarga(pembayaran.total_bayar)}}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <strong>Rp. {{formatHarga(grand_total)}}</strong>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" v-print="'#printMe2'">
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
      pembayarans: [],
      semua_pembayaran: [],
      halaman: 1,
      tanggal_sekarang: this.tanggalSekarang()
    };
  },
  mounted() {
    this.ambilData();
    this.LaporanPembayaran();
  },
  computed: {
    total_hasil: function() {
      return this.pembayarans.reduce((total, jumlah_total) => {
        return total + jumlah_total.total_bayar;
      }, 0);
    },
    grand_total: function() {
      return this.semua_pembayaran.reduce((total, jumlah_total) => {
        return total + jumlah_total.total_bayar;
      }, 0);
    }
  },
  methods: {
    ambilData() {
      axios
        .get("/pembayaran?sort=tanggal&page=" + this.halaman)
        .then(response => {
          const pembayaran = response.data;
          this.pembayarans = pembayaran.filter(pembayaran =>
            pembayaran.tanggal.includes(this.tanggal_sekarang)
          );
        });
    },
    LaporanPembayaran() {
      axios.get("/pembayaran?sort=tanggal").then(response => {
        this.semua_pembayaran = response.data;
      });
    },
    HalamanLanjut() {
      this.halaman = this.halaman + 1;
      this.ambilData();
    },
    HalamanSebelumnya() {
      this.halaman = this.halaman - 1;
      this.ambilData();
    },
    HapusData(id_nota, number) {
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
          console.log(id_nota);
          console.log(number);
          axios.delete("/meja/" + id_nota).then(response => {
            this.pembayarans.splice(number, 1);
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
    formatHarga(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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