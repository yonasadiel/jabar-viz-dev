<template>
  <div>
    <Navbar />
    <div class="d-flex flex-column align-items-center container" >
      <h1 class="title">Ganti Password</h1>
      <div class="form">
        <div class="form-group">
          <label>Password Baru</label>
          <input type="password" v-model="password">
        </div>
        <div class="form-group">
          <label>Ketik Ulang Password Baru</label>
          <input type="password" v-model="repassword">
        </div>
        <div class="error">{{ this.error }}</div>
        <div class="success">{{ this.success }}</div>
        <div class="d-flex flex-row justify-content-center">
          <Loader v-if="this.loading"/>
          <button v-if="!this.loading" class="btn" v-on:click="savePassword">Ganti</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import Loader from '@/components/Loader.vue';
import api from '../api';

export default {
  name: 'ChangePassword',
  components: {
    Loader,
  },
  data: () => ({
    password: '',
    repassword: '',
    loading: '',
    error: '',
    success: '',
  }),
  computed: {
    ...mapState({
      user: state => state.auth.user,
    }),
  },
  methods: {
    savePassword() {
      this.error = '';
      this.success = '';
      if (this.password === this.repassword) {
        const apiUrl = `/users/${this.user.id}`;
        this.loading = true;
        api.patch(apiUrl, { password: this.password }).then(() => {
          this.loading = false;
          this.password = '';
          this.repassword = '';
          this.success = 'Password berhasil diganti';
        });
      } else {
        this.error = 'Password yang diketikkan ulang berbeda dengan password awal';
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import '../styles/components/form';

.form {
  max-width: 800px;
  width: 70%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.title {
  text-align: center;
  margin: 1.5em 0;
}

.form-button{
  text-align: center;
}

.error {
  color: red;
  font-size: $text-sm;
  text-align: center;
}

.success {
  color: green;
  font-size: $text-sm;
  text-align: center;
}
</style>
