<script setup>
import AuthLayout from "@/components/layouts/AuthLayout.vue";
import imageURL from '@/assets/images/login.png'
import {ref} from "vue";
import {useRouter} from "vue-router";
import {useStore} from "vuex";

const router = useRouter ();
const store = useStore();


const email = ref('')
const password = ref('')
const errorMsg = ref('')
const errors = ref([])
const login = () => {
  const user = {
    email : email.value,
    password : password.value
  }
  store.dispatch('login', user)
    .then((response) => {
      console.log("Response:", response);
      console.log("TOKEN:", localStorage.getItem('TOKEN'));
      if (response.success) {
        router.push({ name: 'candidatDashboard' });
      }
    })



}
</script>

<template>
  <AuthLayout :imageURL="imageURL"  :pageName="'Login'">
    <form class="space-y-6" action="" @submit.prevent="login">
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex flex-col" role="alert" v-if="Object.keys(errors).length">
        <strong class="font-bold">{{errorMsg}}</strong>
        <div  v-for="(fieldErrors, field) in errors" :key="field">
          <span class="block sm:inline"  v-for="(error, index) in fieldErrors" :key="index">● {{error}}</span>
        </div>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 transition-colors cursor-pointer " @click="errors=[]">
          <svg class="fill-current h-6 w-6 text-red-500 hover:text-red-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
      </div>
      <div>
        <label class="block text-sm font-medium mb-2">Email</label>
        <input type="email" placeholder="Email" v-model="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
      </div>
      <div>
        <label class="block text-sm font-medium mb-2">Password</label>
        <input type="password" placeholder="Password" v-model="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
      </div>

      <button type="submit" class="w-full py-3 bg-purple-700 text-white rounded-lg font-medium hover:bg-purple-800 transition-colors">Login</button>

      <p class="text-center text-sm text-gray-600 mt-4">
        Don't have a Candidat account ? <router-link to="/register/signUpCandidat" class="text-blue-600 hover:underline">Sign Up Candidat</router-link>
      </p>
      <p class="text-center text-sm text-gray-600 mt-4">
        Don't have a Recruteur account ? <router-link to="/register/signUpRecruteur" class="text-blue-600 hover:underline">Sign Up Recruteur</router-link>
      </p>
    </form>

  </AuthLayout>
</template>


<style scoped>

</style>
