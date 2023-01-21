<template>
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FORM TAMBAH MEJA</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" v-on:submit.prevent="TambahData()">
          <div class="box-body">
            <div class="form-group">
              <label>KODE MEJA</label>
              <input type="text" v-model="mejas.id_meja" class="form-control" disabled>
            </div>
            <div class="form-group">
              <label>NOMOR MEJA</label>
              {{mejas.nomor_meja}}
              <input type="text" v-model="mejas.nomor_meja" class="form-control" maxlength="2">
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
     mejas: {
        id_meja: this.rndStr(2),
        nomor_meja: "",
        
      }
    };
  },
  methods: {
    TambahData() {
      axios.post("/meja", this.mejas).then(response => {
        
        this.TambahBerhasil();
        this.$router.push({ name: "indexMeja" });
      });
    },
    TambahBerhasil() {
      // $swal function calls SweetAlert into the application with the specified configuration.
      this.$swal("Sukses!", "Data Berhasil Di Tambah!", "success");
    },
      rndStr(len)
    {
      
    	let text = "MJ-"
    	let chars = "1234567890"
      
      for( let i=0; i < len; i++ )
      {
				text += chars.charAt(Math.floor(Math.random() * chars.length))
      }
		 return text
		}
       
  }
};
</script>
