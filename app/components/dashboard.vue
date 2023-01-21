<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-7">
              <label>Kategori Menu :</label>
              <select v-model="kategori">
                <option value disabled hidden>--Pilih Kategori Menu--</option>
                <option
                  v-for="row in kategoriMenu"
                  :key="row.id_ktmenu"
                  v-bind:value="row.nama_kategori"
                >{{row.nama_kategori}}</option>
              </select>
            </div>
          </div>
          <div class="col-md-4" v-for="(menu) in filterKategori" :key="menu.id_menu">
            <div class="box">
              <div class="box-header with-border border-primary bg-blue">
                <h5>{{menu.nama }}</h5>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <strong>Rp. {{formatHarga(menu.harga) }}</strong>

                <span v-if="menu.stok!=0">Stok : {{menu.stok}}</span>
                <span class="label label-danger" v-else>Habis</span>

                <button
                  class="btn btn-xs btn-success pull-right"
                  @click="TambahKeranjang(menu.id_menu,menu.nama,menu.harga,menu.id_ktmenu,menu.stok,pesanan.id_pesan)"
                  v-if="menu.stok"
                >+</button>
              </div>
              <!-- /.box-body -->
              <!-- box-footer -->
            </div>
            <!-- /.box -->
          </div>
        </div>

        <div class="col-md-5">
          <div class="box">
            <div class="box-header with-border bg-black-active">
              <h5 class="box-title">DAFTAR PESANAN</h5>
              <h5 class="box-title pull-right">ID :{{pesanan.id_pesan}}</h5>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <label>
                <strong>KATEGORI PEMESANAN :</strong>
              </label>
              <select v-model="pesanan.id_ktpesan" @change="OnChange($event)" class="form-control">
                <option value disabled hidden>--Pilih Kategori Pesanan--</option>
                <option
                  v-for="ktpesan in kategoriPesan"
                  :key="ktpesan.id_ktpesan"
                  v-bind:value="ktpesan.id_ktpesan"
                >{{ktpesan.nama_kategori}}</option>
              </select>

              <br />
              <label v-if="tampil">
                <strong>MEJA :</strong>
              </label>

              <select v-model="pesanan.id_meja" class="form-control" v-if="tampil">
                <option value disabled hidden>--Pilih Pilih Nomor Meja--</option>
                <option
                  v-for="meja in mejas"
                  :key="meja.id_meja"
                  v-bind:value="meja.id_meja"
                >{{meja.nomor_meja}}</option>
              </select>
              <br />

              <table class="table table-bordered table-striped">
                <thead class="bg-primary">
                  <th>NO</th>
                  <th>NAMA ITEM</th>
                  <th>QTY</th>
                  <th>HARGA</th>
                  <th>AKSI</th>
                </thead>
                <tbody>
                  <tr v-if="!keranjang.length">
                    <td colspan="5">
                      <h4 class="text-center">Belum Ada Pesanan</h4>
                    </td>
                  </tr>
                  <tr v-for="(krj, number) in keranjang" :key="krj.id_pesan">
                    <td>{{number+1}}</td>
                    <td>{{krj.nama}}</td>
                    <td>{{krj.jumlah}}</td>
                    <td>
                      <strong>Rp. {{formatHarga(krj.harga*krj.jumlah)}}</strong>
                    </td>
                    <td>
                      <button
                        class="btn btn-xs btn-warning"
                        @click="KurangiJumlah(krj.id_menu)"
                        v-if="krj.jumlah"
                      >-</button>
                      <button
                        class="btn btn-xs btn-primary"
                        @click="hapusCart(number,krj.id_menu)"
                      >X</button>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <strong>TOTAL</strong>:
                    </td>
                    <td>
                      <strong>{{total_qty}}</strong>
                    </td>
                    <td>
                      <strong>Rp. {{formatHarga(total_harga)}}</strong>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="5">
                      <strong>KETERANGAN:</strong>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="5">
                      <textarea
                        v-model="pesanan.keterangan"
                        class="form-control"
                        placeholder="Masukan Keterangan Tambahan"
                      ></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-primary btn-xs pull-left" @click="ProsesPesanan()">PROSES</button>
            </div>
            <!-- box-footer -->
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
      menus: [],
      mejas: [],
      kategoriMenu: [],
      kategoriPesan: [],
      keranjang: [],
      pesanan: {
        id_pesan: "",
        id_ktpesan: "",
        id_meja: "",
        id_user: "",
        tanggal: "",
        keterangan: ""
      },
      tampil: false,
      kategori: "Makanan",
      data_pesanan: []
    };
  },
  mounted() {
    let id_user = this.$route.params.id_user;
    let level = this.$route.params.level;
    this.pesanan.id_user = id_user;
    this.pesanan.tanggal = this.tanggalSekarang();
    this.ambilData();
    this.AmbilMeja();
    this.AmbilKategoriPesan();
    this.AmbilKategoriMenu();
    this.AmbilDataPesanan();

    if (!localStorage.length) {
      this.SetLocalStorage();
    } else {
      this.GetLocalStorage();
    }
    this.pesanan.id_ktpesan = this.kategoriPesan.id_ktpesan;
  },

  computed: {
    total_qty: function() {
      return this.keranjang.reduce((total, keranjang) => {
        return total + keranjang.jumlah;
      }, 0);
    },
    total_harga: function() {
      return this.keranjang.reduce((total, keranjang) => {
        return total + keranjang.harga * keranjang.jumlah;
      }, 0);
    },
    filterKategori() {
      return this.menus.filter(row => row.id_ktmenu === this.kategori);
    }
  },
  methods: {
    ambilData() {
      axios.get("/menu").then(response => {
        this.menus = response.data;
      });
    },
    AmbilKategoriPesan() {
      axios.get("/kategori-pesan").then(response => {
        this.kategoriPesan = response.data;
      });
    },
    AmbilKategoriMenu() {
      axios.get("/kategori-menu").then(response => {
        this.kategoriMenu = response.data;
      });
    },
    AmbilMeja() {
      axios.get("/meja?sort=nomor_meja").then(response => {
        this.mejas = response.data;
      });
    },
    AmbilDataPesanan() {
      axios.get("/pesanan").then(response => {
        this.data_pesanan = response.data;
        if (!this.data_pesanan.length) {
          this.pesanan.id_pesan = "1999";
        } else {
          let DataTerkahir = this.data_pesanan.slice(-1)[0];
          let IdPesanBaru = parseInt(DataTerkahir.id_pesan) + 1;
          let toString = IdPesanBaru.toString();
          this.pesanan.id_pesan = toString;
          console.log(IdPesanBaru);
        }
      });
    },
    TambahKeranjang(id_menu, nama, harga, id_ktmenu, stok, id_pesan) {
      let stok_baru = stok - 1;
      console.log(stok_baru);
      axios
        .patch("/menu/" + id_menu, {
          stok: stok_baru
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(error => console.log(error.response.data));

      let cari = this.keranjang.find(
        keranjang => keranjang.id_menu == id_menu
      );

      if (cari) {
        cari.jumlah++;
      } else {
        this.keranjang.push({
          id_menu: id_menu,
          jenis_menu: id_ktmenu,
          nama: nama,
          harga: harga,
          jumlah: 1,
          status_order: 1
        });
      }
      this.SetLocalStorage();

      let value = this.menus.find(menu => menu.id_menu === id_menu);
      if (value) {
        value.stok--;
      }
    },
    hapusCart(number, id_menu) {
      let cari = this.keranjang.find(
        keranjang => keranjang.id_menu === id_menu
      );

      let cari_stok = this.menus.find(menu => menu.id_menu === id_menu);

      if (cari_stok) {
        axios
          .patch("/menu/" + id_menu, {
            stok: cari_stok.stok + cari.jumlah
          })
          .then(response => {
            console.log(response.data);
          })
          .catch(error => console.log(error.response.data));
      }
      let value = this.menus.find(menu => menu.id_menu === id_menu);
      if (value) {
        value.stok = value.stok + cari.jumlah;
      }

      this.keranjang.splice(number, 1);
      this.SetLocalStorage();
    },
    KurangiJumlah(id_menu, nama, harga) {
      let cari_stok = this.menus.find(menu => menu.id_menu === id_menu);
      console.log(cari_stok);

      if (cari_stok) {
        axios
          .patch("/menu/" + id_menu, {
            stok: cari_stok.stok + 1
          })
          .then(response => {
            console.log(response.data);
          })
          .catch(error => console.log(error.response.data));
      }
      let cari = this.keranjang.find(
        keranjang => keranjang.id_menu === id_menu
      );
      if (cari) {
        cari.jumlah--;
      }
      this.SetLocalStorage();
      let value = this.menus.find(menu => menu.id_menu === id_menu);
      if (value) {
        value.stok++;
      }
    },
    ProsesPesanan() {
      axios
        .post("/pesanan", this.pesanan)
        .then(response => {
          this.PesanBerhasil();
        })
        .catch(error => console.log(error.response.data));

      for (let i = 0; i < this.keranjang.length; i++) {
        axios
          .post("/pesanan-detail", {
            id_pesan: this.pesanan.id_pesan,
            id_menu: this.keranjang[i].id_menu,
            jenis_menu: this.keranjang[i].jenis_menu,
            harga: this.keranjang[i].harga,
            jumlah: this.keranjang[i].jumlah,
            status_order: this.keranjang[i].status_order
          })
          .then(response => {
            console.log(response.data);
          })
          .catch(error => console.log(error.response.data));
      }

      localStorage.clear("keranjang");
      this.keranjang = [];
      this.SetLocalStorage();
      this.OneSingal();
    },
    SetLocalStorage() {
      localStorage.setItem("keranjang", JSON.stringify(this.keranjang));
    },
    GetLocalStorage() {
      this.keranjang = JSON.parse(localStorage.getItem("keranjang"));
    },

    OnChange(event) {
      let key = event.target.value;

      if (key == "KP001") {
        this.tampil = true;
      } else {
        this.pesanan.id_meja = null;
        this.tampil = false;
      }
    },
   
    PesanBerhasil() {
      // $swal function calls SweetAlert into the application with the specified configuration.
      this.$swal("Sukses!", "Data Berhasil Di Tambah!", "success");
    },
    OneSingal() {
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
        contents: { en: "HALO ! ADA PESANAN BARU SILAHKAN CEK DATA PESANAN" },
        included_segments: ["All"]
      };

      sendNotification(message);
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