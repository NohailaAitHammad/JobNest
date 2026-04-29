import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import sigUpCandidat from '../views/sigUpCandidat.vue'
import sigUpRecruteur from '../views/sigUpRecruteur.vue'
import login from "@/views/login.vue";
import signUpTalent from '@/views/SignUpTalent.vue'
import DefaultLayout from "@/components/layouts/DefaultLayout.vue";
import un from "@/views/un.vue";
import CandidatDashboard from "@/views/Candidats/CandidatDashboard.vue";
import CandidatLayout from "@/components/layouts/CandidatLayout.vue";
import store from "@/store/index.js";
import AuthLayout from "@/components/layouts/AuthLayout.vue";
import RecruteurLayout from "@/components/layouts/RecruteurLayout.vue";
import RecruteurDashboard from "@/views/Recruteurs/RecruteurDashboard.vue";
import AdminLayout from "@/components/layouts/AdminLayout.vue";
import AdminDashboard from "@/views/Admin/AdminDashboard.vue";


const routes = [
  {
    path: '/',
    redirect : '/home',
    name: 'home',
    component: DefaultLayout,
    children : [
      {
        path:'/home', name: 'Home', component: HomeView
      },
    ]
  },
  {
    path: '/candidats',
    name : 'candidats',
    component : CandidatLayout,
    meta : {requiresAuth : true},
    children : [
      {
        path : '/candidats/dashboard', name : 'candidatDashboard', component: CandidatDashboard
      }
    ]
  },
  {
    path: '/recruteurs',
    redirect : '/recruteurs/dashboard',
    name : 'recruteurs',
    component : RecruteurLayout,
    children : [
      {
        path : '/recruteurs/dashboard', name : 'recruteurDashboard', component: RecruteurDashboard
      }
    ],
    meta : {requiresAuth : true}
  },
  {
    path: '/admin',
    redirect : '/admin/dashboard',
    name : 'admin',
    component :AdminLayout,
    children : [
      {
        path : '/admin/dashboard', name : 'adminDashboard', component: AdminDashboard
      }
    ],
    meta : {requiresAuth : true}
  },
  {
    path : "/register/signUpRecruteur",
    name : "sigUpRecruteur",
    meta : {isGuest : true},
    component :sigUpRecruteur
  },
  {
    path : "/register/signUpCandidat",
    name : "signUpCandidat",
    meta : {isGuest : true},
    component :sigUpCandidat
  },
  {
    path : "/login",
    name : "login",
    meta : {isGuest : true},
    component :login
  },


]


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {

  const token = store.state.auth.token;
  const user = store.state.auth.user;
  const role = store.state.auth.role;

  if(to.meta.requiresAuth && !token){
    next({name:'login'})
  }

  if(token && to.meta.isGuest){
    switch(role){
      case 'candidat' : return next({name:'candidatDashboard'});
      case 'recruteur' : return next({name:'home'});
      case 'admin' : return next({name:'adminDashboard'});
      default : return next({name : 'login'})
    }
  }

  return next();
})



export default router
