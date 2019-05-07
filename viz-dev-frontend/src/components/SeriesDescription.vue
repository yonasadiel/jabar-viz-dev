<template>
  <div class="flex-row flex-wrap container__card">
    <div v-for="propsCard in propsCards" v-bind:key="propsCard.name">
      <Card v-bind="propsCard" />
    </div>
  </div>
</template>

<script>
import Card from '@/components/Card.vue';
import api from '@/api';

export default {
  name: 'SeriesDescription',
  components: {
    Card,
  },
  data() {
    return {
      propsCards: [],
    };
  },
  created() {
    api.get('/series').then((response) => {
      const series = response.data;
      for (let i = 0; i < series.length; i += 1) {
        this.propsCards.push({
          name: series[i].name,
          desc: series[i].description,
        });
      }
    });
  },
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
  align-items: stretch;
  justify-content: center;
}
</style>
