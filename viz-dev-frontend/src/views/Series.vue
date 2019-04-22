<template>
  <div>
    <Navbar></Navbar>
    <div class="container d-flex flex-column align-items-center">
      <h1 class="title">Edit Series</h1>
      <button class="btn" v-on:click="toggleModalSeriesCreate">Tambah Series</button>
      <ModalSeriesCreate
        v-if="showModalSeriesCreate"
        @modalClosed="toggleModalSeriesCreate" />
      <div class="d-flex flex-row justify-content-center flex-wrap">
        <router-link
          v-bind:to="{ name: 'SeriesEdit', params: { id: content.id }}"
          class="btn menu"
          v-for="content in contents"
          v-bind:key="content.id">
          {{ content.name }}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/api';
import ModalSeriesCreate from '@/components/ModalSeriesCreate.vue';

export default {
  name: 'Series',
  components: {
    ModalSeriesCreate,
  },
  data: () => ({
    isLoadingSeries: false,
    showModalSeriesCreate: false,
    contents: [],
    showAddData: false,
  }),
  methods: {
    displayAddData() {
      this.showAddData = true;
    },
    toggleModalSeriesCreate() {
      if (this.showModalSeriesCreate) {
        // update series list after editing
        this.retrieveSeries();
      }

      this.showModalSeriesCreate = !this.showModalSeriesCreate;
    },
    retrieveSeries() {
      this.isLoadingSeries = true;
      api.get('/series').then((response) => {
        this.contents = response.data;
        this.isLoadingSeries = false;
      });
    },
  },
  created() {
    this.retrieveSeries();
  },
};
</script>

<style lang="scss" scoped>
.title {
  text-align: center;
  margin: 1.5em 0;
}

.btn.menu {
  width: 125px;
  transition: transform .5s ease;
  transform: scale(1);
}

.btn.menu:hover {
  transform: scale(1.1);
}

</style>
