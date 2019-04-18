import Vue from 'vue';
import Router from 'vue-router';
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
      name: 'home',
      component: Home,
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue'),
    },
    {
      path: '/manage',
      name: 'ManageAccount',
      component: ManageAccount,
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
    },
    {
      path: '/edit',
      name: 'Edit',
      component: Edit,
    },
    {
      path: '/edit_data',
      name: 'Edit_Data',
      component: EditData,
    },
  ],
});
