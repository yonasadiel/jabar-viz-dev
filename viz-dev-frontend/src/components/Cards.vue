<template>
  <div class="cards">
    <div v-for="picture in pictures">
        <img src="#" alt="button_play" />
        <div class="container">
            <h4><b>{{ picture.name }}</b></h4>
            <p> {{ picture.desc }} </p>
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
        {name:"Play Button", link:"@/assets/button_play.png", desc:"Menampilkan data tahun ke tahun dalam animasi"},
        {name:"Color", link:"@/assets/color.png", desc:"Color desc"},
        {name:"Sumbu X", link:"@/assets/dropdown_x.png", desc:"Sumbu X desc"},
        {name:"Sumbu Y", link:"@/assets/dropdown_y.png", desc:"Sumbu Y desc"},
        {name:"Expand", link:"@/assets/expand.png", desc:"Expand desc"},
        {name:"Find", link:"@/assets/find.png", desc:"Find desc"},
        {name:"Option", link:"@/assets/option.png", desc:"Option desc"},
        {name:"Present", link:"@/assets/present.png", desc:"Present desc"},
        {name:"Timeline", link:"@/assets/timeline.png", desc:"Timeline desc"},
        {name:"Zoom", link:"@/assets/zoom.png", desc:"Zoom desc"},
    ]
    }
  }
};
</script>

<style scoped>
.card__helper {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 250px;
  height: 200px;
  margin: 5px 10px;
}

.card__helper:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
</style>
