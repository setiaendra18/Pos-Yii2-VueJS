<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FORM TAMBAH KATEGORI PEMESANAN</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" v-on:submit.prevent="TambahData()">
          <div class="box-body">
            <div class="form-group">
              <label>ID-KATEGORI</label>
              <input type="text" v-model="kategoriPesan.id_ktpesan" class="form-control" disabled>
            </div>
            <div class="form-group">
              <label>NAMA KATEGORI</label>
              <input type="text" v-model="kategoriPesan.nama_kategori" class="form-control" maxlength="15">
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
      kategoriPesan: {
        id_ktpesan: this.rndStr(2),
        nama_kategori: "",
        
      }
    };
  },
  methods: {
    TambahData() {
      axios.post("/kategori-pesan", this.kategoriPesan).then(response => {
        
        this.TambahBerhasil();
        this.$router.push({ name: "indexKategoriPesan" });
      });
    },
    TambahBerhasil() {
      // $swal function calls SweetAlert into the application with the specified configuration.
      this.$swal("Sukses!", "Data Berhasil Di Tambah!", "success");
    },
      rndStr(len)
    {
      
    	let text = "KP-"
    	let chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"
      
      for( let i=0; i < len; i++ )
      {
				text += chars.charAt(Math.floor(Math.random() * chars.length))
      }
		 return text
		}
       
  }
};
</script>
