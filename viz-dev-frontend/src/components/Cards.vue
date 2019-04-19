<template>
  <div class="flex-row flex-wrap container__card">
    <div v-for="picture in pictures">
      <div class="cards">
        <img v-bind:src="require('@/assets/' + picture.link)" id="logo"/>
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
        {name:"Play Button", link:"button_play.png", desc:"Menampilkan data tahun ke tahun dalam animasi"},
        {name:"Color", link:"color.png", desc:"Color desc"},
        {name:"Sumbu X", link:"dropdown_x.png", desc:"Sumbu X desc"},
        {name:"Sumbu Y", link:"dropdown_y.png", desc:"Sumbu Y desc"},
        {name:"Expand", link:"expand.png", desc:"Expand desc"},
        {name:"Find", link:"find.png", desc:"Find desc"},
        {name:"Option", link:"option.png", desc:"Option desc"},
        {name:"Present", link:"present.png", desc:"Present desc"},
        {name:"Timeline", link:"timeline.png", desc:"Timeline desc"},
        {name:"Zoom", link:"zoom.png", desc:"Zoom desc"},
    ]
    }
  }
};
</script>

<style scoped>

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
