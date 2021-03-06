import Vue from 'vue';
import Router from 'vue-router';
import Users from '../components/stateless/Users';
import Pets from '../components/stateless/Pets';
import Appointments from '../components/stateless/Appointments';
import Home from '../components/Home'
import MedicalHistory from '../components/statefull/MedicalHistory' 
import RegisterForm from '../components/stateless/RegisterForm'
import LogInForm from '../components/stateless/LogInForm'
Vue.use(Router);

export default new Router({
  mode : 'history',
  routes: [
    {path: '/',                             component: Home},
    {path: '/register',                     component: RegisterForm},
    {path: '/users', redirect: '/',                        component: Users},
    {path: '/pets',                         component: Pets},
    {path: '/appointments',                 component: Appointments},
    {path: '/login',                        component: LogInForm},
    {path: '/pets/medicalHistory/:petId',   component: MedicalHistory},
  ]
});