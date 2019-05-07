<template>
  <div class="flex-row flex-wrap container__card">
    <div v-for="propsCard in propsCards" v-bind:key="propsCard.name" class="card">
      <Card v-bind="propsCard" />
    </div>
  </div>
</template>

<script>
import Card from '@/components/Card.vue';

export default {
  name: 'ChartLegend',
  components: {
    Card,
  },
  data() {
    return {
      propsCards: [
        {
          name: 'Play Button', link: 'button_play.png', desc: 'Menampilkan data tahun ke tahun dalam animasi',
        },
        {
          name: 'Color', link: 'color.png', desc: 'Mengubah warna bulatan berdasarkan range nilai',
        },
        {
          name: 'Sumbu X', link: 'dropdown_x.png', desc: 'Mengubah variabel sumbu X',
        },
        {
          name: 'Sumbu Y', link: 'dropdown_y.png', desc: 'Mengubah variabel sumbu Y',
        },
        {
          name: 'Expand', link: 'expand.png', desc: 'Membuat grafik ditampilkan full screen',
        },
        {
          name: 'Find', link: 'find.png', desc: 'Memilih kota-kota secara spesifik',
        },
        {
          name: 'Option', link: 'option.png', desc: 'Mengatur tampilan grafik',
        },
        {
          name: 'Present', link: 'present.png', desc: 'Menyajikan grafik dalam presentasi bersih',
        },
        {
          name: 'Timeline', link: 'timeline.png', desc: 'Tahun-tahun pada data untuk ditampilkan',
        },
        {
          name: 'Zoom', link: 'zoom.png', desc: 'Zoom in atau zoom out pada grafik',
        },
      ],
    };
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
