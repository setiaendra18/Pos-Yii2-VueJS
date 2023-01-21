<template>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">DETAIL PESANAN</h3>
      <h3 class="box-title pull-right">NOMOR ORDER : {{pesanan.id_pesan}}</h3>
    </div>
    <div class="box-body">
      <div class="col-md-5" ref="printTable">
        <table class="table table-responsive" >
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
      <table class="table table-bordered table-striped" >
        <thead class="bg-primary">
          <th>NO</th>
          <th>NAMA ITEM</th>
          <th>HARGA</th>
          <th>JUMLAH BELI</th>
          <th>SUB TOTAL</th>
        </thead>
        <tbody>
          <tr v-for="(pesanan, number ) in detail_pesanans" >
            <td>{{number+1}}</td>
            <td>{{pesanan.id_menu}}</td>
            <td>Rp. {{formatHarga(pesanan.harga)}}</td>
            <td>{{pesanan.jumlah}}</td>

            <td>Rp. {{formatHarga(pesanan.jumlah*pesanan.harga)}}</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>
              <strong>TOTAL</strong>
            </td>
            <td>
              <strong>{{total_qty}}</strong>
            </td>
            <td>
              <strong>Rp. {{formatHarga(total_harga)}}</strong>
            </td>
          
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button
        type="button"
        class="btn btn-info"
        data-toggle="modal"
        data-target="#exampleModal1"
      >CETAK</button>
       <router-link :to="{name: 'indexPembayaran'}" class="btn btn-primary pull-right">KEMBALI</router-link>
    </div>
    <!-- /.box-footer-->
    <!-- Modal -->
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
            <h4 class="modal-title text-center" id="exampleModalLabel">CETAK NOTA</h4>
          </div>
          <div class="modal-body" id="printMe">
            <h3 class="text-center">CAMILES</h3>
            <h4 class="text-center">
              <i>"Spesial Ikan Bakar Patin"</i>
            </h4>
            <br />
            <table class="table table-border">
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
            <br />
            <table class="table table-bordered table-striped">
              <thead>
                <th>NO</th>
                <th>NAMA ITEM</th>
                <th>HARGA</th>
                <th>JUMLAH BELI</th>
                <th>SUB TOTAL</th>
              </thead>
              <tbody>
                <tr v-for="(pesanan, number ) in detail_pesanans">
                  <td>{{number+1}}</td>
                  <td>{{pesanan.id_menu}}</td>
                  <td>Rp. {{formatHarga(pesanan.harga)}}</td>
                  <td>{{pesanan.jumlah}}</td>

                  <td>Rp. {{formatHarga(pesanan.jumlah*pesanan.harga)}}</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <strong>TOTAL</strong>
                  </td>
                  <td>
                    <strong>{{total_qty}}</strong>
                  </td>
                  <td>
                    <strong>Rp. {{formatHarga(total_harga)}}</strong>
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table table-border">
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
          <div class="modal-footer">
            <button class="btn btn-warning" v-print="'#printMe'">
              <i class="fa fa-print"></i>
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box -->
</template>

<script>
export default {
  data: function() {
    return {
      id_pesan: null,
      detail_pesanans: [],
      pesanan: {
        id_pesan: "",
        tanggal: "",
        id_ktpesan: "",
        id_meja: "",
        id_user: "",
        keterangan: ""
      },
      tampil: true
    };
  },
  mounted() {
    let id = this.$route.params.id;
    this.id_pesan = id;
    this.AmbilDetailPesanan();
    this.AmbilPesanan();
    if (this.pesanan.id_meja == "KP002") {
      this.tampil = false;
    }
  },
  computed: {
    total_qty: function() {
      return this.detail_pesanans.reduce((total, jumlah_total) => {
        return total + jumlah_total.jumlah;
      }, 0);
    },
    total_harga: function() {
      return this.detail_pesanans.reduce((total, total_bayar) => {
        return total + total_bayar.harga * total_bayar.jumlah;
      }, 0);
    }
  },
  methods: {
    AmbilDetailPesanan() {
      axios.get("/pesanan-detail").then(response => {
        const products = response.data;
        this.detail_pesanans = products.filter(product =>
          product.id_pesan.includes(this.id_pesan)
        );
      });
    },
    AmbilPesanan() {
      axios.get("/pesanan/" + this.id_pesan).then(response => {
        this.pesanan = response.data;
      });
    },
    BayarPesanan() {
      this.$swal({
        title: "PEMBAYARAN PESANAN",
        input: "text",
        html:
          "<h4>Total Belanja Anda<strong> Rp. " +
          this.formatHarga(this.total_harga) +
          "</strong> </h4>",
        showCloseButton: true
      });
      console.log(this.pesanan.id_pesan);
      axios
        .post("/pembayaran", {
          no_nota: this.rndStr(5),
          id_pesan: this.pesanan.id_pesan,
          tanggal: "",
          total_bayar: this.total_harga,
          status_bayar: 1
        })
        .then(function(response) {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error.response.data);
        });
    },
    RubahStatusPesan(status_order) {
      axios
        .patch(
          "/pesanan-detail/" + this.id_pesan + this.detail_pesanans.id_menu,
          this.detail_pesanans
        )
        .then(response => {
          console.log(response.data);
        })
        .catch(error => console.log(error.response.data));
    },
    formatHarga(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    CekPembayaran() {},
    NoNota() {
      let nomor_nota = "CML" + Date();
    },
    rndStr(len) {
      let text = "CMLS-";
      let chars = "1234567890";
      for (let i = 0; i < len; i++) {
        text += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return text;
    },
    printData()
  {
    var divToPrint= this.$refs.printTable
    newWin= window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
  }
  }
};
</script>
