<template>
  <div>
    <Navbar />
    <div class="d-flex flex-column align-items-center container" >
      <h1 class="title">Login</h1>
      <div class="login">
        <div class="form-group">
          <label>Username</label>
          <input type="text" v-model="username">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" v-model="password">
        </div>
        <div class="error">{{ this.error }}</div>
        <div class="d-flex flex-row justify-content-center">
          <Loader v-if="this.loading"/>
          <button v-if="!this.loading" class="btn" v-on:click="login">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Loader from '@/components/Loader.vue';

export default {
  name: 'Login',
  components: {
    Loader,
  },
  data: () => ({
    username: '',
    password: '',
  }),
  computed: {
    ...mapState({
      error: state => state.auth.error,
      loading: state => state.auth.loading,
    }),
  },
  mounted() {
    const inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i += 1) {
      inputs[i].addEventListener('keyup', (e) => {
        if (e.keyCode === 13) { // enter
          e.preventDefault();
          this.login();
        }
      });
    }
  },
  methods: {
    ...mapActions({
      loginAction: 'auth/login',
    }),
    login() {
      this.loginAction({
        username: this.username,
        password: this.password,
        router: this.$router,
      });
    },
  },
};
</script>

<style scoped lang="scss">
@import '../styles/components/form';

.login {
  max-width: 500px;
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
</style>
