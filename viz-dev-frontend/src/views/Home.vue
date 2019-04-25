<template>
  <div>
    <Navbar></Navbar>
    <Chart></Chart>
    <Cards></Cards>
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

</style>
