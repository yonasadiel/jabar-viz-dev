<template>
  <div class="nav">
    <router-link v-bind:to="linkHome" class="d-flex flex-row align-items-center">
      <img v-bind:src="logo" class="logo" /> Jabar Viz Dev
    </router-link>
    <router-link
      v-if="user"
      v-bind:to="linkSeries"
      class="d-flex flex-row align-items-center">
        Edit
    </router-link>
    <router-link
      v-if="user"
      v-bind:to="linkChangePassword"
      class="d-flex flex-row align-items-center">
        Ganti Password
    </router-link>
    <router-link
      v-if="user && user.role === 'admin'"
      v-bind:to="linkAccount"
      class="d-flex flex-row align-items-center">
        Akun
    </router-link>
    <div class="flex-1"></div>
    <div class="flex-0" v-if="user">{{ user.username }}</div>
    <router-link v-if="!user" v-bind:to="linkLogin" class="d-flex flex-row align-items-center">
      Login
    </router-link>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import logo from '@/assets/logo-jabar.png';
import Account from '@/views/ManageAccount.vue';
import ChangePassword from '@/views/ChangePassword.vue';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import Series from '@/views/Series.vue';

export default {
  data: () => ({
    logo,
    linkAccount: Account,
    linkChangePassword: ChangePassword,
    linkHome: Home,
    linkLogin: Login,
    linkSeries: Series,
  }),
  computed: {
    ...mapState({
      user: state => state.auth.user,
    }),
  },
};
</script>

<style lang="scss" scoped>
@import '../styles/base';

.nav {
  list-style-type: none;
  display: flex;
  flex-direction: row;
  align-items: center;
  background-color: $primary;
  color: white;

  > * {
    height: 40px;
    padding: 10px 10px;
  }

  .logo {
    height: 20px;
    margin-right: 10px;
  }

  a:hover {
    cursor: pointer;
    background-color: rgba(255, 255, 255, .1);
  }
}
</style>
