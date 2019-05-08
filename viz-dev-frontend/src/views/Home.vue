<template>
  <div>
    <Navbar></Navbar>
    <Chart></Chart>
    <div class="block">
      <h3>Deskripsi</h3>
      <SeriesDescription></SeriesDescription>
    </div>
    <div class="block">
      <h3>Legenda</h3>
      <ChartLegend></ChartLegend>
    </div>
  </div>
</template>

<script>
import ChartLegend from '@/components/ChartLegend.vue';
import SeriesDescription from '@/components/SeriesDescription.vue';
import Chart from '@/components/Chart.vue';

export default {
  name: 'Home',
  components: {
    Chart,
    ChartLegend,
    SeriesDescription,
  },
};
</script>

<style scoped>
h3 {
  text-align: center;
  margin: 12px 0;
}

.block {
  margin-bottom: 50px;
}
</style>
