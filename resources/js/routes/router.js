import Vue from 'vue';
import Router from 'vue-router';
import Users from '../components/stateless/Users';
import Pets from '../components/stateless/Pets';
import Appointments from '../components/stateless/Appointments';
import Home from '../components/Home'

Vue.use(Router);

export default new Router({
  mode : 'history',
  routes: [
    {path: '/',                 component: Home},
    {path: '/users',            component: Users},
    {path: '/pets',             component: Pets},
    {path: '/appointments',     component: Appointments}
  ]
});