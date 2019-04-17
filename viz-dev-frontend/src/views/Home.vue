<template>
  <div>
    <Navbar></Navbar>
    <Chart></Chart>
  </div>
</template>

<script>
import Chart from '@/components/Chart.vue';

export default {
  name: 'home',
  components: {
    Chart,
  },
};
</script>

<style scoped>

</style>
