<template>
  <div class="modal">
    <div class="modal-background" v-on:click="closeModal"> </div>
    <div class="modal-content">
      <span class="close" v-on:click="closeModal">&times;</span>
      <div class="modal-header">
        <h2>Ubah User</h2>
      </div>
      <div class="modal-body">
        <p> Nama: <input type="text" v-model="workingUser.username"></p>
        <p> Email: <input type="email" v-model="workingUser.email"></p>
        <p> Role:
          <select v-model="workingUser.role">
            <option value="admin">admin</option>
            <option value="pemprov">pemprov</option>
            <option value="dinas">dinas</option>
          </select>
        </p>
        <button class="btn" v-on:click="saveUser">Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/api';

export default {
  name: 'ModalEditRole',
  props: ['user'],
  created() {
    this.workingUser = Object.assign({}, this.user);
  },
  components: {},
  methods: {
    saveUser() {
      const apiUrl = `/users/${this.workingUser.id}`;
      api.patch(apiUrl, this.workingUser).then(() => {
        this.closeModal();
      });
    },
    closeModal() {
      this.$emit('modalClosed');
    },
  },
};
</script>

<style scoped lang="scss">
@import '../styles/components/modal';
@import '../styles/components/form';

.modal-body p {
  margin-bottom: 1em;
}
</style>
