import api from '../api';

export default {
  namespaced: true,
  state: {
    modifiedEntries: {},
  },
  getters: {
    isLoggedIn(state) {
      return !!state.user;
    },
    isAdmin(state) {
      return !!state.user && (state.user.role === 'admin');
    },
  },
  mutations: {
    /* eslint-disable no-param-reassign */
    addModifiedEntries(state, entry) {
      if (!state.modifiedEntries[entry.series_id]) {
        state.modifiedEntries[entry.series_id] = {};
      }
      if (!state.modifiedEntries[entry.series_id][entry.year]) {
        state.modifiedEntries[entry.series_id][entry.year] = {};
      }
      state.modifiedEntries[entry.series_id][entry.year][entry.cities_id] = entry;
    },
    clearModifiedEntries(state) {
      state.modifiedEntries = {};
    },
  },
  actions: {
    save({ state }) {
      const promises = [];
      /* eslint-disable no-restricted-syntax */
      /* eslint-disable guard-for-in */
      for (const seriesId in state.modifiedEntries) {
        for (const year in state.modifiedEntries[seriesId]) {
          for (const citiesId in state.modifiedEntries[seriesId][year]) {
            const entry = state.modifiedEntries[seriesId][year][citiesId];
            let promise = null;
            if (entry.value !== '') {
              promise = api.post(`/series/${entry.series_id}/city/${entry.cities_id}/year/${entry.year}/entry`, entry);
            } else {
              promise = api.delete(`/series/${entry.series_id}/city/${entry.cities_id}/year/${entry.year}/entry`, entry);
            }
            promises.push(promise);
          }
        }
      }
      return Promise.all(promises);
    },
    modify({ commit }, entry) {
      commit('addModifiedEntries', entry);
    },
  },
};
