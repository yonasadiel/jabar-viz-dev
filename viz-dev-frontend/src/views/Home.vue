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
  name: 'home',
  components: {
    Chart: Chart,
    Cards: Cards
  },
  data() {
    return {
      
    }
  }
};
</script>

<style scoped>

</style>
