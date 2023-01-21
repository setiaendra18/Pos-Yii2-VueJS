<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FORM TAMBAH DATA MENU</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" v-on:submit.prevent="TambahData()" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label>ID MENU</label>

              <input type="text" v-model="menu.id_menu" class="form-control" disabled>
            </div>

            <div class="form-group">
              <label>NAMA</label>
              <input type="text" v-model="menu.nama" class="form-control">
            </div>
            <div class="form-group">
              <label>KATEGORI MENU</label>
              <select v-model="menu.id_ktmenu" class="form-control">
                <option value disabled hidden>--Pilih Kategori Menu--</option>
                <option
                  v-for="kategorimenu in kategoriMenus"
                  :key="kategorimenu.id_ktmenu"
                  v-bind:value="kategorimenu.id_ktmenu"
                >{{kategorimenu.id_ktmenu}}-{{kategorimenu.nama_kategori}}</option>
              </select>
            </div>
            <div class="form-group">
              <label>SATUAN</label>
              <select v-model="menu.satuan" class="form-control">
                <option value disabled hidden>--Pilih Satuan Menu--</option>
                <option value="Pcs">PCS</option>
                <option value="Porsi">Porsi</option>
              </select>
            </div>
            <div class="form-group">
              <label>HARGA</label>
              <input type="text" v-model="menu.harga" class="form-control">
            </div>
            <div class="form-group">
              <label>JUMLAH STOK</label>
              <input type="text" v-model="menu.stok" class="form-control">
            </div>
            <div class="form-group">
              <label>deskripsi</label>
              <textarea v-model="menu.deskripsi" class="form-control"></textarea>
            </div>
          </div>
          <!-- /.box-body -->
         
          <div class="box-footer">
            <button type="submit" class="btn btn-warning">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      menu: {
        id_menu: this.rndStr(4),
        nama: "",
        id_ktmenu: "",
        satuan: "",
        harga: "",
        stok: "",
        deskripsi: "",
      },
      kategoriMenus: []
    };
  },
  mounted() {
    this.AmbilKategoriMenu();
  },
  methods: {
    TambahData() {
      axios
        .post("/menu", this.menu)
        .then(response => {
          this.TambahBerhasil();
          this.$router.push({ name: "indexMenu" });
        });
    },
    AmbilKategoriMenu() {
      axios.get("/kategori-menu").then(response => {
        this.kategoriMenus = response.data;
      });
    },
    TambahBerhasil() {
      // $swal function calls SweetAlert into the application with the specified configuration.
      this.$swal("Sukses!", "Data Berhasil Di Tambah!", "success");
    },

    onFileChanged(event)
    {
      this.foto = event.target.files[0];
      this.menu.foto = this.foto;

    },
    rndStr(len) {
      let text = "CM-";
      let chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

      for (let i = 0; i < len; i++) {
        text += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return text;
    }
  }
};
</script>
