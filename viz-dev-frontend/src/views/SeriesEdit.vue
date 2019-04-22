<template>
  <div>
    <Navbar></Navbar>
    <div class="container">
      <div class="title">
        <h1>Edit Series</h1>
        <Loader class="loader series-title" v-if="isLoadingSeries" />
        <h2 v-if="!isLoadingSeries">{{ this.series.name }}</h2>
      </div>
      <div class="flex-row table" v-if="!isLoadingEntries">
        <div class="flex-col col-header">
          <div class="row-header">Kab / Kota</div>
          <div class="row-entry" v-for="city in cities" v-bind:key="city.id">{{ city.name }}</div>
        </div>
        <div class="flex-col col-entry" v-for="year in Object.keys(years)" v-bind:key="year">
          <div class="row-header">{{ year }}</div>
          <div class="row-entry" v-for="city in cities" v-bind:key="city.id">
            <input type="text" class="number-entry" v-model="entries[year][city.id]" />
          </div>
        </div>
      </div>
      <button class="btn save">Simpan</button>
    </div>
  </div>
</template>

<script>
import api from '@/api';
import Loader from '@/components/Loader.vue';

export default {
  name: 'SeriesEdit',
  components: {
    Loader,
  },
  data: () => ({
    cities: [],
    series: {
      id: 0,
      name: '',
      description: '',
    },
    years: {},
    yearsList: [],
    entries: {},
    isLoadingSeries: false,
    isLoadingCities: false,
    isLoadingEntries: false,
  }),
  created() {
    this.retrieveSeries();
    this.retrieveCities();
    this.retrieveEntries();
  },
  methods: {
    retrieveSeries() {
      this.isLoadingSeries = true;
      api.get(`/series/${this.$route.params.id}`).then((response) => {
        this.series = response.data;
        this.isLoadingSeries = false;
      });
    },
    retrieveCities() {
      this.isLoadingCities = true;
      api.get('/cities').then((response) => {
        this.cities = response.data;
        this.isLoadingCities = false;
      });
    },
    retrieveEntries() {
      this.isLoadingEntries = true;
      this.years = {};
      api.get(`/series/${this.$route.params.id}/entries`).then((response) => {
        for (let i = 0; i < response.data.length; i += 1) {
          const entry = response.data[i];
          this.years[entry.year] = true;
          if (!this.entries[entry.year]) {
            this.entries[entry.year] = {};
          }
          this.entries[entry.year][entry.cities_id] = entry.value;
        }
        this.isLoadingEntries = false;
      });
    },
  },
};
</script>

<style scoped>
.title {
  text-align: center;
  margin: 1.5em 0;
}

.loader.series-title {
  height: 20px;
}

.flex-row {
  display: flex;
  flex-direction: row;
}

.flex-col {
  display: flex;
  flex-direction: column;
}

/* flex container */
.grid__edit--form {
  display: grid;
  grid-template-columns: auto auto auto auto auto auto auto;
  padding: 10px;
}

.grid__edit--form > input:active,
.grid__edit--form > input:focus {
  outline: none;
}

.grid__edit--form > label {
  text-align: center;
}

.btn.save {
  float: right;
  margin-right: 0;
}

.col-header {
  flex: 1 1;
  min-width: 200px;
}

.col-entry {
  flex: 0 0;
  flex-basis: 20px;
}

.row-header {
  font-weight: 600;
  font-size: .8em;
}

.row-header,
.row-entry {
  height: 40px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.row-entry:nth-child(even) {
  background-color: rgba(0, 0, 0, .05);
}

.col-header .row-header, .col-header .row-entry {
  align-items: flex-start;
}

.number-entry {
  text-align: center;
  padding: 5px;
  margin: 5px;
  width: 70px;
  border: 0;
  border-bottom: 2px solid rgba(0, 0, 0, .5);
  background-color: transparent;
}

.number-entry:active,
.number-entry:focus,
.number-entry:hover {
  outline: none;
  background-color: rgba(6, 116, 210, .05);
  border-bottom: 2px solid rgba(6, 116, 210, 1);
}

.table {
  overflow-x: scroll;
}

</style>
