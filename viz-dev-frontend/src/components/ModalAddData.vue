<template>
  <div class="modal__show--data">
    <div class="modal__content">
        <div class="modal__header">
            <span class="close" @click="$emit('close')">&times;</span>
            <h2>Add Data</h2>
        </div>
        <div class="modal__body">
            <p><span>Nama Data Baru</span>: <input type="text" class="number-entry"></p>
        </div>
        <div class="modal__footer">
            <button class="btn__add">Add</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalAddData',
  components: {
  },
};
</script>

<style scoped>
.modal__show--data {
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

.modal__footer {
    text-align: center;
}

span {
  font-weight: 600;
}

.btn__delete {
    border: 0;
    background-color: rgba(247, 91, 101, 1);
    border-radius: 5px;
    box-shadow: 2px 2px 8px 2px rgba(0, 0, 0, .2);
    padding: 10px 15px;
    cursor: pointer;
    font-weight: 600;
    margin: 10px 5px;
    color: white;
}

.btn__delete:hover {
    background-color: rgb(242, 75, 85);
    transform: scale(1.1);
}

.btn__add {
    border: 0;
    background-color: rgba(6, 116, 210, 1);
    border-radius: 5px;
    box-shadow: 2px 2px 8px 2px rgba(0, 0, 0, .2);
    padding: 10px 15px;
    cursor: pointer;
    font-weight: 600;
    margin: 10px 5px;
    color: white;
}

.btn__add:hover {
    background-color: rgb(10, 84, 150);
    transform: scale(1.1);
}
</style>
