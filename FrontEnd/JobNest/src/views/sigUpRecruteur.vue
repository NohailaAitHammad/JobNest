<script setup>
import AuthLayout from "@/components/layouts/AuthLayout.vue";
import imageURL from '@/assets/images/signUpCandidat.png'
import {useRouter} from "vue-router";
import {ref} from "vue";
import store from "@/store/index.js";

const router = useRouter();
const firstName = ref('');
const lastName = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');

const errorMsg = ref('')
const errors = ref([])
const registerRecruteur = () => {
  const user = {
    firstName : firstName.value,
    lastName : lastName.value,
    email : email.value,
    password : password.value,
    password_confirmation : password_confirmation.value
  }
  store.dispatch('signUpRecruteur', user)
    .then((response) => {
      console.log("Response:", response);
      console.log("TOKEN:", localStorage.getItem('TOKEN'));
      if (response.success) {
        router.push({ name: 'recruteurDashboard' });
      }
    })
    .catch((error) => {
      console.log("Error:", error);
      errorMsg.value = error.response.data.message
      errors.value = error.response.data.errors
    });

}

</script>

<template>
  <AuthLayout :imageURL="imageURL" :User="'Recruteur'" :pageName="'Signup'">
    <form  class="space-y-4" action="" @submit.prevent="registerRecruteur">
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
        <label class="block text-sm font-medium mb-3">FirstName</label>
        <input type="text" placeholder="FirstName" v-model="firstName"  id="firstName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
      </div>

      <div>
        <label class="block text-sm font-medium mb-2">LastName</label>
        <input type="text" placeholder="LastName" v-model="lastName" id="lastName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
      </div>

      <div>
        <label class="block text-sm font-medium mb-2">Email</label>
        <input type="email" placeholder="Email Address" v-model="email"  id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
      </div>

      <div>
        <label class="block text-sm font-medium mb-2">Password</label>
        <input type="password" placeholder="Password" v-model="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
      </div>

      <div>
        <label class="block text-sm font-medium mb-2">Confirm Password</label>
        <input type="password" placeholder="Confirm Password"  v-model="password_confirmation" id="password_confirmation"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
      </div>

      <button  class="w-full py-3 bg-purple-700 text-white rounded-lg font-medium hover:bg-purple-800 transition-colors mt-6">Signup</button>

      <p class="text-center text-sm text-gray-600 mt-4">
        Already have an account? <router-link to="/login" class="text-blue-600 hover:underline">Login</router-link>
      </p>
    </form>
  </AuthLayout>
</template>


<style scoped>

</style>
