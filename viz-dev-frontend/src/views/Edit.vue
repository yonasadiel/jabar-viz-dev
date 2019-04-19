<template>
  <div>
    <Navbar></Navbar>
    <div class="container">
        <h1 class="title">JABAR DATA VISUALIZATION EDITING CENTER</h1>
        <div class="container__data">
            <div class="btn__data" v-for="content in contents" @click="redirectPage(content.name)">
              {{ content.name }}
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Edit',
  components: {
  },
  data(){
    return{
      contents: [
        {name: 'Harapan Lama Sekolah'},
        {name: 'Rata-Rata Lama Sekolah'},
        {name: 'IPM'},
        {name: 'Jumlah Penduduk Miskin'},
        {name: 'Persentase Penduduk Miskin'},
        {name: 'Indeks Kedalaman Kemiskinan'},
        {name: 'Indeks Keparahan Kemiskinan'},
        {name: 'Garis Kemiskinan'},
        {name: 'Gini Ratio'},
        {name: 'Jumlah Penduduk'},
        {name: 'Laju Pertumbuhan'},
        {name: 'Kepadatan Penduduk'},
        {name: 'Rumah Sakit'},
        {name: 'Puskesmas'},
        {name: 'Petugas Medis'},
        {name: 'Dokter'},
        {name: 'Bidan'},
        {name: 'Jumlah SD Negeri/Swasta'},
        {name: 'Jumlah SLTP Negeri/Swasta'},
        {name: 'Jumlah SLTA Negeri/Swasta'},
        {name: 'Jumlah SMK Negeri/Swasta'},
        {name: 'Tingkat Partisipasi Angkatan Kerja P/L'},
        {name: 'Tingkat Pengangguran Terbuka (P/L) (Jiwa)'},
        {name: 'Industri Besar'},
        {name: 'Industri Kecil'},
      ]
    }
  },
  methods: {
    redirectPage: function (content) {
      this.$router.push({path:'edit_data', query: { data: content }});
    }
  }
};
</script>

<style scoped>
.title {
    text-align: center;
}
.container {
    padding: 40px 76px;
    text-align: center;
}

.container__data {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    margin: 40px 0;
}

.btn__data {
    background-color: #0e76bf;
    color: white;
    font-size: 1.2em;
    border-radius: 5px;
    margin: 10px;
    width: 125px;
    padding: 16px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: transform .5s ease;
    transform: scale(1);
    box-shadow: 2px 2px 8px 2px rgba(0, 0, 0, .2);
}


</style>
