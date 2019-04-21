<template>
  <div class="nav">
    <router-link v-bind:to="linkHome" class="d-flex flex-row align-items-center">
      <img v-bind:src="logo" class="logo" /> Jabar Viz Dev
    </router-link>
    <router-link v-bind:to="linkEdit" class="d-flex flex-row align-items-center">
      Edit
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
import Home from '@/views/Home.vue';
import Edit from '@/views/Edit.vue';
import Login from '@/views/Login.vue';

export default {
  data: () => ({
    logo,
    linkHome: Home,
    linkEdit: Edit,
    linkLogin: Login,
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
