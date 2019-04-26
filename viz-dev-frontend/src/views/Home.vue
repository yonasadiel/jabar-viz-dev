<template>
  <div>
    <Navbar></Navbar>
    <Chart></Chart>
    <Cards></Cards>
    <h3 class="data-series">Data Series</h3>
    <CardsSeries></CardsSeries>
  </div>
</template>

<script>
import Chart from '@/components/Chart.vue';
import Cards from '@/components/Cards.vue';
import CardsSeries from '@/components/CardsSeries.vue';

export default {
  name: 'Home',
  components: {
    Chart,
    Cards,
    CardsSeries,
  },
};
</script>

<style scoped>
.data-series {
  text-align: center;
  margin: 12px 0;
}
</style>
