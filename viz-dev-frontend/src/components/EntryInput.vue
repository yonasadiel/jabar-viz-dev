<template>
  <input
    type="text"
    v-bind:class="{ 'number-entry': true, 'modified': modified }"
    v-model="editedValue"
    v-on:change="modify" />
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: 'EntryInput',
  components: {},
  props: ['entry', 'year', 'cityId', 'seriesId'],
  data: () => ({
    modified: false,
    editedValue: null,
  }),
  created() {
    if (!this.entry) {
      this.editedValue = '';
    } else {
      this.editedValue = this.entry.value;
    }
  },
  methods: {
    ...mapActions({
      modifyAction: 'entry/modify',
    }),
    modify() {
      if (!this.entry || this.editedValue !== this.entry.value) {
        this.modified = true;
        this.modifyAction(Object.assign(
          { year: this.year, cities_id: this.cityId, series_id: this.seriesId },
          this.entry,
          { value: this.editedValue },
        ));
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import '../styles/base';

.number-entry {
  text-align: center;
}

.number-entry.modified,
.number-entry.modified,
.number-entry.modified {
  outline: none;
  background-color: rgba(216, 210, 6, .05);
  border-bottom: 2px solid rgba(216, 210, 6, 1);
}

</style>
