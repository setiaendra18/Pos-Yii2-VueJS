<template>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">DETAIL PESANAN</h3>
      <h3 class="box-title pull-right">NOMOR ORDER : {{pesanan.id_pesan}}</h3>
    </div>
    <div class="box-body table-responsive">
      <div class="col-md-5 table-responsive">
        <table class="table table-responsive">
          <tr>
            <td>
              <strong>JENIS PESANAN</strong>
            </td>
            <td>:</td>
            <td>{{pesanan.id_ktpesan}}</td>
          </tr>
          <tr>
            <td>
              <strong>PESANAN</strong>
            </td>
            <td>:</td>
            <td>{{pesanan.tanggal}}</td>
          </tr>
          <tr>
            <td>
              <strong>NOMOR MEJA</strong>
            </td>
            <td>:</td>
            <td>{{pesanan.id_meja}}</td>
          </tr>
          <tr>
            <td>
              <strong>NAMA PELAYAN</strong>
            </td>
            <td>:</td>
            <td>{{pesanan.id_user}}</td>
          </tr>
        </table>
      </div>
      <div class="col-md-5">
        <table class="table table-striped">
          <tr>
            <td>
              <strong>KETERANGAN TAMBAHAN:</strong>
            </td>
          </tr>
          <tr>
            <td>
              <strong>
                <i>"{{pesanan.keterangan}}"</i>
              </strong>
            </td>
          </tr>
        </table>
      </div>
     
      <br />
      <table class="table table-bordered table-striped">
        <thead class="bg-primary">
          <th>NO</th>
          <th>NAMA</th>
         
          <th>JUMLAH</th>
          
          <th>STATUS ORDER</th>
        </thead>
        <tbody>
         
          <tr v-for="(pesanan, number ) in filterKategori">
            <td>{{number+1}}</td>
            <td>{{pesanan.id_menu}}</td>
           
            <td>{{pesanan.jumlah}}</td>

          
            <td width="100">
              <button
                class="btn btn-danger btn-light btn-block"
                v-if="pesanan.status_order===1"
                @click="RubahStatusPesan(pesanan.id,pesanan.status_order=2)"
              >BELUM DI PROSES</button>
              <button
                class="btn btn-success btn-light btn-block"
                v-else-if="pesanan.status_order===2"
                @click="RubahStatusPesan(pesanan.id,pesanan.status_order=1)" 
              >SELESAI DI PROSES</button>
            </td>
          </tr>
        
        </tbody>
      </table>
      <div class="box-footer clearfix">
            <p>
              <router-link
                :to="{name: 'indexPesanan',params:{id_user:id_user,level:level}}"
                class="btn btn-primary pull-right"
              >KEMBALI</router-link>
            </p>
          </div>
    </div>
    <!-- /.box-body -->
   
    <!-- /.box-footer-->

    <!-- Button trigger modal -->

  </div>
  <!-- /.box -->
</template>

<script>
export default {
  data: function() {
    return {
      id_pesan: null,
      detail_pesanans: [],
      kategoriMenu: [],
      pesanan: {
        id_pesan: "",
        tanggal: "",
        id_ktpesan: "",
        id_meja: "",
        id_user: "",
        keterangan: ""
      },
      tampil: true,
      tombol_bayar: true,
      pembayarans: [],
      kembalian: "",
      nominal_bayar: "",
      id_user: "",
      level: "",
      kategori: ""
    };
  },
  mounted() {
    let id = this.$route.params.id;
    let id_user = this.$route.params.id_user;
    let level = this.$route.params.level;
    this.id_user = id_user;
    this.level = level;
    if(this.level==2)
    {
      this.kategori="Makanan"
    }
    else if(this.level==3)
    {
      this.kategori="Minuman"
      
    }
    console.log(level);
    console.log(id_user);
    this.id_pesan = id;
    this.CekPembayaran();
    this.AmbilDetailPesanan();
    this.AmbilPesanan();
    this.AmbilKategoriMenu();
  },
  computed: {
   
    filterKategori() {
      return this.detail_pesanans.filter(
        row => row.jenis_menu === this.kategori
      );
    }
  },
  methods: {
    AmbilDetailPesanan() {
      axios.get("/pesanan-detail").then(response => {
        const pesanan = response.data;
        this.detail_pesanans = pesanan.filter(product =>
          product.id_pesan.includes(this.id_pesan)
        );
      });
    },
    AmbilPesanan() {
      axios.get("/pesanan/" + this.id_pesan).then(response => {
        this.pesanan = response.data;
      });
    },
    AmbilKategoriMenu() {
      axios.get("/kategori-menu").then(response => {
        this.kategoriMenu = response.data;
      });
    },
    BayarPesanan() {
      axios
        .post("/pembayaran", {
          no_nota: this.rndStr(5),
          id_pesan: this.pesanan.id_pesan,
          tanggal: "",
          total_bayar: this.total_harga,
          status_bayar: 1
        })
        .then(function(response) {})
        .catch(function(error) {
          console.log(error.response.data);
        });

      this.$router.push({ name: "indexPesanan" });
      window.location.reload();
    },
    RubahStatusPesan(id, status_order) {
      //console.log(id);
      //console.log(status_order);

      axios
        .patch("/pesanan-detail/" + id, {
          status_order: status_order
        })
        .then(response => {
          //console.log(response.data);
        })
        .catch(error => console.log(error.response.data));
    },
    formatHarga(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    CekPembayaran() {
      axios.get("/pembayaran").then(response => {
        this.pembayarans = response.data;
        let cari = this.pembayarans.find(
          pembayaran => pembayaran.id_pesan == this.id_pesan
        );
        console.log(cari.id_pesan);
        console.log(this.id_pesan);
        if (cari.id_pesan === this.id_pesan) {
          this.tombol_bayar = false;
        }
      });
    },
    rndStr(len) {
      let text = "CMLS-";
      let chars = "1234567890";
      for (let i = 0; i < len; i++) {
        text += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return text;
    }
  }
};
</script>
