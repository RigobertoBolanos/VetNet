import Vue from 'vue';
import Router from 'vue-router';
import Users from '../components/Users';
import Pets from '../components/Pets';
import Services from '../components/Services';
import Appointments from '../components/Appointments';
import MedicalHistories from '../components/MedicalHistories';
import Home from '../components/Home'

Vue.use(Router);

export default new Router({
  mode : 'history',
  routes: [
    {path: '/',                 component: Home},
    {path: '/users',            component: Users},
    {path: '/pets',             component: Pets},
    {path: '/services',         component: Services},
    {path: '/appointments',     component: Appointments},
    {path: '/medicalHistories', component: MedicalHistories}
  ]
});