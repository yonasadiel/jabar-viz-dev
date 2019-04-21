import api from '../api';

export default {
  namespaced: true,
  state: {
    user: null,
    error: '',
    loading: false,
  },
  getters: {
    isLoggedIn(state) {
      return !!state.user;
    },
  },
  mutations: {
    /* eslint-disable no-param-reassign */
    setError(state, message) {
      state.error = message;
    },
    clearError(state) {
      state.error = '';
    },
    setLoading(state, isLoading) {
      state.loading = isLoading;
    },
    setUser(state, user) {
      state.user = user;
    },
  },
  actions: {
    login({ commit }, { username, password, router }) {
      commit('setLoading', true);
      commit('clearError');
      api
        .post('/login', { username, password })
        .then((response) => {
          commit('setUser', response.data);
          commit('setLoading', false);
          router.push('/edit');
        }).catch((err) => {
          commit('setLoading', false);
          commit('setError', err.response.data.message);
        });
    },
  },
};
