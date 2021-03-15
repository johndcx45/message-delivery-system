import VueRouter from 'vue-router';
import Vue from 'vue';
import LoginPageComponent from './components/LoginPageComponent';
import BackofficePageComponent from './components/BackofficePageComponent';
import RegularPageComponent from './components/RegularPageComponent';

Vue.use(VueRouter);

export const routes = [
  {
    path: '/login',
    name: 'login',
    component: LoginPageComponent,
    meta: {
      auth: false
    }
  },
  {
    path: '/backoffice',
    name: 'backoffice',
    component: BackofficePageComponent,
    meta: {
      auth: true
    }
  },
  {
    path: '/regular',
    name: 'regular',
    component: RegularPageComponent,
    meta: {
      auth: true
    }
  }
]