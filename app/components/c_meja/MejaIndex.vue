<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">DATA MEJA</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-border-primary">
              <thead class="bg-primary">
                <th>No.</th>

                <th>NOMOR MEJA</th>
                <th>AKSI</th>
              </thead>
              <tr v-for="(meja, number ) in mejas" :key="meja.id_meja">
                <td>{{number+1}}</td>

                <td>{{meja.nomor_meja }}</td>

                <td>
                  <router-link :to="{name: 'EditMeja', params: {id: meja.id_meja}}">
                    <i class="fa fa-edit text-primary"></i>
                  </router-link>&nbsp;
                  <a href="#" v-on:click="HapusData(meja.id_meja, number)">
                    <i class="fa fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            <p>
              <router-link :to="{name: 'TambahMeja'}" class="btn btn-success">Tambah</router-link>
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
      mejas: []
    };
  },
  mounted() {
    this.ambilData();
  },
  methods: {
    ambilData() {
      axios.get("/meja?sort=nomor_meja").then(response => {
        this.mejas = response.data;
      });
    },

    HapusData(id_meja, number) {
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
          console.log(id_meja);
          console.log(number);
          axios.delete("/meja/" + id_meja).then(response => {
            this.mejas.splice(number, 1);
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