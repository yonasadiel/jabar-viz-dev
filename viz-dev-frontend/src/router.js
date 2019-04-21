import Vue from 'vue';
import Router from 'vue-router';
import { requireAdmin, requireGuest, requireLogin } from './guard';
import Home from './views/Home.vue';
import ManageAccount from './views/ManageAccount.vue';
import Login from './views/Login.vue';
import Edit from './views/Edit.vue';
import EditData from './views/EditData.vue';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/manage',
      name: 'ManageAccount',
      component: ManageAccount,
      beforeEnter: requireAdmin,
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      beforeEnter: requireGuest,
    },
    {
      path: '/edit',
      name: 'Edit',
      component: Edit,
      beforeEnter: requireLogin,
    },
    {
      path: '/edit_data',
      name: 'Edit_Data',
      component: EditData,
      beforeEnter: requireLogin,
    },
  ],
});
