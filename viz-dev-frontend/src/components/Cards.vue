<template>
  <div class="flex-row flex-wrap container__card">
    <div v-for="picture in pictures">
      <div class="cards">
        <img v-bind:src="require('@/assets/' + picture.link)" :class="picture.logo"/>
        <div class="container">
          <h4><b>{{ picture.name }}</b></h4>
          <p> {{ picture.desc }} </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Cards',
  data() {
    return {
        pictures: [
        {name:"Play Button", link:"button_play.png", desc:"Menampilkan data tahun ke tahun dalam animasi", logo:""},
        {name:"Color", link:"color.png", desc:"Mengubah warna bulatan berdasarkan range nilai", logo:"logo__follow--btnPlay"},
        {name:"Sumbu X", link:"dropdown_x.png", desc:"Mengubah variabel sumbu X", logo:"logo__dropdown--x"},
        {name:"Sumbu Y", link:"dropdown_y.png", desc:"Mengubah variabel sumbu Y", logo:""},
        {name:"Expand", link:"expand.png", desc:"Membuat grafik ditampilkan full screen", logo:"logo__follow--btnPlay"},
        {name:"Find", link:"find.png", desc:"Memilih kota-kota secara spesifik", logo:"logo__follow--btnPlay"},
        {name:"Option", link:"option.png", desc:"Mengatur tampilan grafik", logo:"logo__follow--btnPlay"},
        {name:"Present", link:"present.png", desc:"Menyajikan grafik dalam presentasi bersih", logo:"logo__follow--btnPlay"},
        {name:"Timeline", link:"timeline.png", desc:"Tahun-tahun pada data untuk ditampilkan", logo:"logo__timeline"},
        {name:"Zoom", link:"zoom.png", desc:"Zoom in atau zoom out pada grafik", logo:"logo__follow--btnPlay"},
    ]
    }
  }
};
</script>

<style scoped>
.logo__follow--btnPlay {
  width: 45px;
  height: 43px;
}

.logo__dropdown--x {
  width: 200px;
  height: 26px;
}

.logo__timeline {
  width: 200px;
  height: 29px;
}

.flex-row {
  display: flex;
  flex-direction: row;
}

.flex-wrap {
  flex-wrap: wrap;
}

.container__card {
  text-align: center;
  align-items: center;
  justify-content: center;
}

.cards {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 200px;
  height: 165px;
  margin: 5px 10px;
  padding: 5px;
  cursor: pointer;
}

.cards:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
  transform: scale(1.1);
}

.container {
  padding: 2px 16px;
}
</style>
