<template>
  <div class="modal">
    <div class="modal-background" v-on:click="closeModal"> </div>
    <div class="modal-content">
      <span class="close" v-on:click="closeModal">&times;</span>
      <div class="modal-header">
        <h2>Buat Series</h2>
      </div>
      <div class="modal-body">
        <p> Nama Series: <input type="text" v-model="workingSeries.name"></p>
        <p> Deskripsi: <input type="text" v-model="workingSeries.description"></p>
        <p class="error">{{error}}</p>
        <button class="btn" v-on:click="saveSeries">Simpan</button>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/api';

export default {
  name: 'ModalSeriesCreate',
  components: {},
  data: () => ({
    workingSeries: {
      name: '',
      description: '',
    },
    error: '',
  }),
  methods: {
    saveSeries() {
      api.post('/series', this.workingSeries).then(() => {
        this.closeModal();
      }).catch((err) => {
        this.error = err.response.data.message;
      });
    },
    closeModal() {
      this.$emit('modalClosed');
    },
  },
};
</script>

<style lang="scss" scoped>
@import '../styles/components/modal';
@import '../styles/components/form';

.modal-body p {
  margin-bottom: 1em;
}

.error {
  color: red;
}
</style>
