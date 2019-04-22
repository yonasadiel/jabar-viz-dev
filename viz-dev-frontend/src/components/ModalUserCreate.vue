<template>
  <div class="modal">
    <div class="modal-background" v-on:click="closeModal"> </div>
    <div class="modal-content">
      <span class="close" v-on:click="closeModal">&times;</span>
      <div class="modal-header">
        <h2>Buat User</h2>
      </div>
      <div class="modal-body">
        <p> Username: <input type="text" v-model="workingUser.username"></p>
        <p> Email: <input type="email" v-model="workingUser.email"></p>
        <p> Password: <input type="password" v-model="workingUser.password"></p>
        <p> Role:
          <select v-model="workingUser.role">
            <option value="admin">Admin</option>
            <option value="pemprov">Pemprov</option>
            <option value="dinas">Dinas</option>
          </select>
        </p>
        <p class="error">{{error}}</p>
        <button class="btn" v-on:click="saveUser">Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/api';

export default {
  name: 'ModalEditRole',
  created() {
    this.workingUser.role = 'dinas';
  },
  data() {
    return {
      workingUser: {
        username: '',
        password: '',
        email: '',
        role: 'dinas',
      },
      error: '',
    };
  },
  components: {},
  methods: {
    saveUser() {
      const apiUrl = '/users';
      api.post(apiUrl, this.workingUser).then(() => {
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

<style scoped lang="scss">
@import '../styles/components/modal';
@import '../styles/components/form';

.modal-body p {
  margin-bottom: 1em;
}

.error {
  color: red;
}
</style>
