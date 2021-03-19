import VueRouter from 'vue-router';
import Vue from 'vue';

import LoginPageComponent from './components/LoginPageComponent';
import BackofficePageComponent from './components/BackofficePageComponent';
import RegularPageComponent from './components/RegularPageComponent';
import AdminPageComponent from './components/AdminPageComponent';
import ShowMessagesComponent from './/components/ShowMessagesComponent';
import CreateAnnouncementComponent from './components/CreateAnnouncementComponent';
import EditAnnouncementComponent from './components/EditAnnouncementComponent';
import UsersPageComponent from './components/UsersPageComponent';

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
    path: '/admin',
    name: 'admin',
    component: AdminPageComponent,
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
  },
  {
    path: '/view',
    name: 'View',
    component: ShowMessagesComponent
  },
  {
    path: '/create',
    name: 'Create',
    component: CreateAnnouncementComponent
  },
  {
    path: '/home',
    name: 'Home',
    component: AdminPageComponent
  },
  {
    path: '/edit',
    name: 'Edit',
    component: EditAnnouncementComponent
  },
  {
    path: '/register',
    name: 'Register',
    component: UsersPageComponent
  }
]