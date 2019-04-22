<template>
  <div>
    <Navbar></Navbar>
    <Chart></Chart>
    <Cards></Cards>
  </div>
</template>

<script>
import Chart from '@/components/Chart.vue';
import Cards from '@/components/Cards.vue';

export default {
  name: 'Home',
  components: {
    Chart,
    Cards,
  },
};
</script>

<style scoped>

</style>
