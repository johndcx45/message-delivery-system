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
import FullViewComponent from './components/FullViewComponent';
import BackofficeInboxComponent from './components/BackofficeInboxComponent';
import RegularInboxComponent from './components/RegularInboxComponent';
import FullViewRegularComponent from './components/FullViewRegComponent';
import LoginFailedComponent from './components/LoginFailedComponent';

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
    path: '/register',
    name: 'Register',
    component: UsersPageComponent
  },
  {
    path: '/fullview',
    name: 'FullView',
    component: FullViewComponent
  },
  {
    path: '/inbox',
    name: 'BackofficeInbox',
    component: BackofficeInboxComponent
  },
  {
    path: '/reginbox',
    name: 'RegularInbox',
    component: RegularInboxComponent
  },
  {
    path: '/fullviewreg',
    name: 'FullViewRegular',
    component: FullViewRegularComponent
  }
]