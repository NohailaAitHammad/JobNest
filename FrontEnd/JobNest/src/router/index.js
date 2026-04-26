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
    redirect : '/candidats/dashboard',
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
    path: '/about',
    name: 'about',
    component: () => import('../views/AboutView.vue'),
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
  if(to.meta.requiresAuth && !store.state.user.token){
    next({name:'login'})
  }else if(store.state.user.token  &&  (to.meta.isGuest)) {
    next({name : 'candidatDashboard'});
  } else if(store.state.user.token && (to.meta.isGuest)){
    next({name : 'recruteurDashboard'});
  }
  /*else if(store.state.user.token && store.state.user.data.role.role === 'admin' && (to.meta.isGuest)){
    next({name : 'adminDashboard'});
  }*/
  else{
    next()
  }
})



export default router
