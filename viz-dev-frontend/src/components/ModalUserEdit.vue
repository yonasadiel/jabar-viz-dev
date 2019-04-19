<template>
  <div class="modal">
    <div class="modal-background" v-on:click="closeModal"> </div>
    <div class="modal-content">
      <span class="close" v-on:click="closeModal">&times;</span>
      <div class="modal-header">
        <h2>Ubah User</h2>
      </div>
      <div class="modal-body">
        <p> Nama: <input type="text" id="username" v-bind:value="user.username"></p>
        <p> Role:
          <select>
            <option value="editor">Editor</option>
            <option value="admin">Admin</option>
          </select>
        </p>
        <button class="btn" @click="saveUser">Save</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalEditRole',
  props: ['user', 'onClose'],
  data: () => ({}),
  components: {},
  methods: {
    saveUser() {
      this.closeModal();
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
