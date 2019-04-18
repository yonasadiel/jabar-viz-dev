<template>
  <div class="modal__show--user">
    <div class="modal__content">
      <div class="modal__header">
        <span class="close" @click="$emit('close')">&times;</span>
        <h2>User Profile</h2>
      </div>
      <div class="modal__body">
        <p><span>Nama</span>: Ajudan Pribadi</p>
        <p><span>Email</span>: ajudan@gmail.com</p>
        <p><span>Institusi</span>: Pemerintah Provinsi Jabar</p>
        <p><span>Role</span>: Editor</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalUser',
  data() {
    return {
    }
  },
  methods: {

  }
};
</script>

<style scoped>
.modal__show--user {
  position: fixed;
  z-index: 1;
  padding-top: 150px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
}

.modal__content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;
}

@keyframes animatetop {
  from {top: -300px; opacity: 0}
  to {top: 0; opacity: 1}
}

.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal__header {
  padding: 2px 16px;
  background-color: rgba(6, 116, 210, 1);
  color: white;
  text-align: center;
}

.modal__body {
  padding: 2px 16px;
  text-align: center;
}

span {
  font-weight: 600;
}
</style>
