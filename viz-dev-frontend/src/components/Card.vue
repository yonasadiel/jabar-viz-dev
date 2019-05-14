<template>
  <div class="card">
    <img v-if="link" v-bind:src="require(`@/assets/${link}`)" class="logo"/>
    <div class="container">
      <h4><b>{{ name }}</b></h4>
      <br/>
      <p class="text-small">{{ sub }}</p>
      <p class="text-small">{{ desc }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',
  props: ['link', 'name', 'sub', 'desc'],
};
</script>

<style scoped>
.logo {
  max-height: 50px;
  max-width: 100%;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  height: 100%;
  width: 200px;
  margin: 5px 10px;
  padding: 10px;
  cursor: pointer;
  z-index: 0;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
  transform: scale(1.1);
  z-index: 100;
}

.text-small {
  font-size: .8em;
}
</style>
