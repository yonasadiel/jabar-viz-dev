<template>
  <div>
    <Navbar></Navbar>
    <div class="d-flex flex-column align-items-center container">
      <div class="title">
        <h1>Edit Series</h1>
        <Loader class="loader" v-if="isLoadingSeries" />
        <div class="d-flex flex-row justify-content-center align-items-center">
          <h2 v-if="!isLoadingSeries">{{ this.series.name }}</h2>
        </div>
      </div>

      <Loader class="loader" v-if="isLoadingSeries" />
      <div class="w-100 align-self-start" v-if="!isLoadingSeries">
        <div>Nama: <input type="text" v-model="series.name"></div>
        <div>Deskripsi: </div>
        <div><textarea type="text" v-model="series.description"></textarea></div>
        <Loader class="loader" v-if="isSavingSeries" />
        <button
          class="btn save-series"
          v-if="!isSavingSeries"
          v-on:click="saveSeries">Simpan</button>
      </div>

      <div class="align-self-start">
        Tambah tahun:
        <input type="number" v-model="addedYear">
        <button
          class="btn add-year"
          v-on:click="addYear">Tambah</button>
      </div>

      <Loader class="loader" v-if="isLoadingEntries" />
      <div class="flex-row table" v-if="!isLoadingEntries">
        <div class="flex-col col-header">
          <div class="row-header">Kab / Kota</div>
          <div class="row-entry" v-for="city in cities" v-bind:key="city.id">{{ city.name }}</div>
        </div>
        <div class="flex-col col-entry" v-for="year in Object.keys(years)" v-bind:key="year">
          <div class="row-header">{{ year }}</div>
          <div class="row-entry" v-for="city in cities" v-bind:key="city.id">
            <EntryInput
              v-bind:year="year"
              v-bind:cityId="city.id"
              v-bind:seriesId="series.id"
              v-bind:entry="entries[year][city.id]"/>
          </div>
        </div>
      </div>

      <Loader class="loader" v-if="isSavingEntries" />
      <button
        class="btn align-self-end save-entries"
        v-if="!isSavingEntries"
        v-on:click="saveEntries">Simpan</button>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import api from '@/api';
import EntryInput from '@/components/EntryInput.vue';
import Loader from '@/components/Loader.vue';

export default {
  name: 'SeriesEdit',
  components: {
    Loader,
    EntryInput,
  },
  data: () => ({
    cities: [],
    series: {
      id: 0,
      name: '',
      description: '',
    },
    years: {},
    entries: {},
    isLoadingSeries: false,
    isLoadingCities: false,
    isLoadingEntries: false,
    isSavingSeries: false,
    isSavingEntries: false,
    addedYear: 2019,
  }),
  created() {
    this.retrieveSeries();
    this.retrieveCities();
    this.retrieveEntries();
  },
  methods: {
    ...mapActions({
      saveAction: 'entry/save',
    }),
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
      this.entries = {};
      api.get(`/series/${this.$route.params.id}/entries`).then((response) => {
        for (let i = 0; i < response.data.length; i += 1) {
          const entry = response.data[i];
          this.years[entry.year] = true;
          if (!this.entries[entry.year]) {
            this.entries[entry.year] = {};
          }
          this.entries[entry.year][entry.cities_id] = entry;
        }
        this.isLoadingEntries = false;
      });
    },
    saveEntries() {
      this.isSavingEntries = true;
      this.saveAction().then(() => {
        this.isSavingEntries = false;
        this.retrieveEntries();
      });
    },
    saveSeries() {
      this.isSavingSeries = true;
      api.patch(`/series/${this.$route.params.id}`, this.series).then((response) => {
        this.isSavingSeries = false;
        this.series = response.data;
      });
    },
    addYear() {
      this.years[this.addedYear] = true;
      if (!this.entries[this.addedYear]) {
        this.entries[this.addedYear] = {};
      }
      this.$forceUpdate();
    },
  },
};
</script>

<style lang="scss" scoped>
@import '../styles/components/form';

.container {
  padding-bottom: 100px;
}

.title {
  text-align: center;
  margin: 1.5em 0;
}

textarea {
  width: 400px;
  max-width: 100%;
  margin-left: 0;
  margin-right: 0;
  margin-top:10px;
}

.btn.save-series {
  margin-left: 0;
}

.btn.add-year {
  display: inline-block;
}

.flex-row {
  display: flex;
  flex-direction: row;
}

.flex-col {
  display: flex;
  flex-direction: column;
}

.btn.save-entries {
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

.row-entry:nth-child(odd), .row-header {
  background-color: rgba(0, 0, 0, .05);
}

.col-header .row-header, .col-header .row-entry {
  align-items: flex-start;
}

.table {
  overflow-x: auto;
  width: 100%;
}

</style>
