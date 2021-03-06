import Vue from 'vue';
import Router from 'vue-router';
import { requireAdmin, requireGuest, requireLogin } from '@/guard';
import ChangePassword from '@/views/ChangePassword.vue';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import ManageAccount from '@/views/ManageAccount.vue';
import Series from '@/views/Series.vue';
import SeriesEdit from '@/views/SeriesEdit.vue';

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
      path: '/changepassword',
      name: 'ChangePassword',
      component: ChangePassword,
      beforeEnter: requireLogin,
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
      path: '/series',
      name: 'Series',
      component: Series,
      beforeEnter: requireLogin,
    },
    {
      path: '/series/:id',
      name: 'SeriesEdit',
      component: SeriesEdit,
      beforeEnter: requireLogin,
    },
  ],
});
