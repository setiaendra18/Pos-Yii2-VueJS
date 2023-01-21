<template>
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title pull-left">DETAIL PESANAN</h3>
      <h3 class="box-title pull-right">NO.ORDER : {{pesanan.id_pesan}}</h3>
    </div>
    <div class="box-body table-responsive">
      <div class="col-md-5 ">
        <table class="table table-responsive ">
          <tr>
            <td>
              <strong>JENIS PESANAN</strong>
            </td>
            <td>:</td>
            <td>{{pesanan.id_ktpesan}}</td>
          </tr>
          <tr>
            <td>
              <strong>TANGGAL</strong>
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
      <table class="table table-bordered table-striped table-responsive ">
        <thead class="bg-primary">
          <th>NO</th>
          <th>NAMA</th>
          <th>HARGA</th>
          <th>QTY</th>
          <th>SUB TOTAL</th>
          <th>STATUS ORDER</th>
          <th>AKSI</th>
        </thead>
        <tbody>
          <tr v-for="(pesanan, number ) in detail_pesanans">
            <td>{{number+1}}</td>
            <td>{{pesanan.id_menu}}</td>
            <td>Rp. {{formatHarga(pesanan.harga)}}</td>
            <td>
              {{pesanan.jumlah}}
              <button
                class="btn btn-xs btn-danger"
                @click="KurangJumlah(pesanan.id,pesanan.jumlah,pesanan.id_menu)"
              v-if="pesanan.jumlah&&tombol_bayar">-</button>
              <button
                class="btn btn-xs btn-success"
                @click="TambahJumlah(pesanan.id,pesanan.jumlah,pesanan.id_menu)"
              v-if="tombol_bayar">+</button>
            </td>

            <td>Rp. {{formatHarga(pesanan.jumlah*pesanan.harga)}}</td>
            <td width="200">
              <span class="label label-danger" v-if="pesanan.status_order==1">SEDANG DI PROSES</span>
              <span
                class="label label-success"
                v-else-if="pesanan.status_order==2"
              >SELESAI DI PROSES</span>
            </td>
            <td>
              <a href="#" v-on:click="HapusData(pesanan.id, number)">
                <i class="fa fa-trash text-danger"></i>
              </a>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <strong>TOTAL</strong>
            </td>
            <td>
              <strong>Rp. {{formatHarga(total_harga)}}</strong>
            </td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button
        type="button"
        class="btn btn-danger"
        v-if="tombol_bayar"
        data-toggle="modal"
        data-target="#exampleModal"
      >BAYAR</button>

      <button
        type="button"
        class="btn btn-primary"
        v-if="tombol_bayar"
        data-toggle="modal"
        data-target="#exampleModal3"
      >TAMBAH MENU</button>

      <button
        type="button"
        class="btn btn-info"
        data-toggle="modal"
        data-target="#exampleModal1"
      >CETAK</button>

      <!--<span class="label label-success" v-else>&nbsp;PESANAN SUDAH DI BAYAR</span>-->
      <router-link
        :to="{name: 'indexPesananKasir',params:{id_user:id_user,level:level}}"
        class="btn btn-primary pull-right"
      >KEMBALI</router-link>
    </div>
    <!-- /.box-footer-->

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center" id="exampleModalLabel">PEMBAYARAN PESANAN</h4>
          </div>
          <div class="modal-body">
            <h3 class="text-center">
              <strong>TOTAL PEMBAYARAN ANDA ADALAH</strong>
            </h3>
            <h2 class="text-center">
              <strong>Rp. {{formatHarga(this.total_harga)}}</strong>
            </h2>
            <input
              type="text"
              v-model="nominal_bayar"
              class="form-control"
              placeholder="Masukan nominal Pembayaran"
            />
            <h2 class="text-center" v-if="nominal_bayar!=0">
              <span v-if="nominal_bayar<this.total_harga">Nominal Pembayaran Kurang</span>
              <span
                v-else-if="nominal_bayar-this.total_harga!=0"
              >Kembalian : Rp. {{formatHarga(nominal_bayar-this.total_harga)}}</span>

              <span v-else-if="nominal_bayar-this.total_harga===0">Tidak Ada Kembalian <br> Uang Pas</span>
            </h2>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
            <button
              type="button"
              class="btn btn-primary"
              v-if="this.nominal_bayar<this.total_harga===false"
              @click="BayarPesanan()"
              data-dismiss="modal"
            >YA BAYAR</button>
          </div>
        </div>
      </div>
    </div>

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

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal3"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-center" id="exampleModalLabel">TAMBAH MENU</h4>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <thead>
                <th>NO</th>
                <th>NAMA</th>
                <th>KATEGORI</th>
                <th>HARGA</th>
                <th>STOK</th>
                <th>AKSI</th>
              </thead>
              <tr v-for="(menu , number) in menus">
                <td>{{number+1}}</td>
                <td>{{menu.nama}}</td>
                <td>{{menu.id_ktmenu}}</td>
                <td>
                  <strong>Rp. {{formatHarga(menu.harga) }}</strong>
                </td>
                <td>
                  <span v-if="menu.stok!=0">Stok : {{menu.stok}}</span>
                  <span class="label label-danger" v-else>Habis</span>
                </td>
                <td>
                  <button
                    class="btn btn-success btn-xs"
                    v-if="menu.stok"
                    @click="TambahMenu(menu.id_menu,menu.stok,menu.id_ktmenu,menu.nama,menu.harga,detail_pesanans.id)"
                  >+</button>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <router-link
              :to="{name: 'indexPesananKasir', params: {id: pesanan.id_pesan,id_user:id_user,level:level}}"
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
            >SELESAI</router-link>
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
      kategoriMenu: [],
      menus: [],
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
      level: ""
    };
  },
  mounted() {
    let id = this.$route.params.id;
    let id_user = this.$route.params.id_user;
    let level = this.$route.params.level;

    this.id_user = id_user;
    this.level = level;

    console.log(level);
    console.log(id_user);
    this.id_pesan = id;
    this.CekPembayaran();
    this.AmbilDetailPesanan();
    this.AmbilPesanan();
    this.AmbilKategoriMenu();
    this.AmbilDataMenu();
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
      axios.get("/pesanan-detail?sort=id_menu").then(response => {
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
    AmbilDataMenu() {
      axios.get("/menu?order=id_ktmenu").then(response => {
        this.menus = response.data;
      });
    },
    BayarPesanan() {
      axios
        .post("/pembayaran", {
          no_nota: this.rndStr(5),
          id_pesan: this.pesanan.id_pesan,
          tanggal: this.tanggalSekarang(),
          total_bayar: this.total_harga,
          status_bayar: 1
        })
        .then(function(response) {})
        .catch(function(error) {
          console.log(error.response.data);
        });

      axios
        .patch("/pesanan/" + this.pesanan.id_pesan, {
          status_pesan: 2
        })
        .then(function(response) {})
        .catch(function(error) {
          console.log(error.response.data);
        });

      this.$router.push({ name: "indexPesananKasir" });
    },
    TambahJumlah(id, jumlah, id_menu) {
      axios
        .patch("/pesanan-detail/" + id, {
          jumlah: jumlah + 1
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(error => console.log(error.response.data));

      let cariData = this.detail_pesanans.find(data => data.id === id);
      if (cariData) {
        cariData.jumlah++;
      }

      let cariDataMenu = this.menus.find(menu => menu.nama === id_menu);

      let stok_baru = cariDataMenu.stok--;

      axios
        .patch("/menu/" + cariDataMenu.id_menu, {
          stok: stok_baru
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(error => console.log(error.response.data));
    },
    KurangJumlah(id, jumlah, id_menu) {
      axios
        .patch("/pesanan-detail/" + id, {
          jumlah: jumlah
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(error => console.log(error.response.data));

      let cariData = this.detail_pesanans.find(data => data.id === id);
      if (cariData) {
        cariData.jumlah--;
      }

      let cariDataMenu = this.menus.find(menu => menu.nama === id_menu);
      let stok_baru = cariDataMenu.stok++;

      axios
        .patch("/menu/" + cariDataMenu.id_menu, {
          stok: stok_baru
        })
        .then(response => {
          console.log(response.data);
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
    },
    HapusData(id, number) {
      console.log(id);
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
          axios.delete("/pesanan-detail/" + id).then(response => {
            this.detail_pesanans.splice(number, 1);
          });

          let cariDataMenu = this.detail_pesanans.find(menu => menu.id === id);
          let cariDataMenu2 = this.menus.find(
            menu => menu.nama === cariDataMenu.id_menu
          );
          console.log(cariDataMenu2);

          axios
            .patch("/menu/" + cariDataMenu2.id_menu, {
              stok: cariDataMenu2.stok + cariDataMenu.jumlah
            })
            .then(response => {
              console.log(response.data);
            })
            .catch(error => console.log(error.response.data));

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
    TambahMenu(id_menu, stok, id_ktmenu, nama, harga, id) {
      let stok_baru = stok - 1;
      console.log(stok_baru);

      axios
        .patch("/menu/" + id_menu, {
          stok: stok_baru
        })
        .then(response => {
          //console.log(response.data);
        })
        .catch(error => console.log(error.response.data));

      let value = this.menus.find(menu => menu.id_menu === id_menu);
      if (value) {
        value.stok--;
      }

      let idMenu = id_menu;
      //KURANGI JUMLAH MENU

      let DataPesan = this.detail_pesanans.find(
        DataPesan => DataPesan.id_pesan === this.id_pesan
      );
      let DataMenu = this.detail_pesanans.find(
        DataMenu => DataMenu.id_menu === this.idMenu
      );

      console.log(DataPesan);
      console.log(DataMenu);

      axios
        .post("/pesanan-detail", {
          id_pesan: this.id_pesan,
          id_menu: id_menu,
          jenis_menu: id_ktmenu,
          nama: nama,
          harga: harga,
          jumlah: 1,
          status_order: 1
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(error => console.log(error.response.data));
        this.OneSingal()
    },
     OneSingal()
     {
      var sendNotification = function(data) {
        var headers = {
          "Content-Type": "application/json; charset=utf-8",
          Authorization:
            "Basic MjQ1NGNlMWYtZjI3Ni00ZGE5LTk1OGMtNWI1NzMyYTNhMDYw"
        };
        var options = {
          host: "onesignal.com",
          port: 443,
          path: "/api/v1/notifications",
          method: "POST",
          headers: headers
        };

        var https = require("https");
        var req = https.request(options, function(res) {
          res.on("data", function(data) {
            console.log("Response:");
            console.log(JSON.parse(data));
          });
        });

        req.on("error", function(e) {
          console.log("ERROR:");
          console.log(e);
        });

        req.write(JSON.stringify(data));
        req.end();
      };

      var message = {
        app_id: "1bd90289-0c1e-419a-bab2-bf400ec66778",
        contents: { en: "TAMBAHAN PESANAN PADA ID PESAN : "+this.pesanan.id_pesan },
        included_segments: ["All"]
      };

      sendNotification(message);
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
