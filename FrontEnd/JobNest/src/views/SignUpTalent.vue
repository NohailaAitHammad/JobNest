<script setup>
import {computed, ref} from 'vue'

const user = ref({});
const firstName = ref('');
const lastName = ref('');
const email = ref('');
const password = ref('');
const password_confiramtion = ref('');

const signUpTalent = computed(() => {
  user.value = {
    firstName : firstName.value,
    lastName : lastName.value,
    email : email.value,
    password : password.value,
    password_confiramtion : password_confiramtion.value
  }
  console.log(user.value)
})

</script>

<template>
  <div class="w-full max-w-6xl grid grid-cols-2 gap-12 items-center p-8">
    <div class="hidden lg:block">
      <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?w=800&auto=format&fit=crop" alt="Signup illustration" class="w-full rounded-2xl">
    </div>
    <div class="max-w-md mx-auto w-full">
      <h1 class="text-4xl font-bold text-center ">Signup</h1>
      <div class="flex gap-8 mb-8 border-b border-gray-200">
        <button class="pb-2 border-b-2 border-purple-700 text-purple-700 font-medium">Talent</button>
      </div>

      <form  class="space-y-4" action="" @submit.prevent="signUpTalent">
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
          <input type="password" placeholder="Confirm Password"  v-model="password_confiramtion" id="password_confiramtion"
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
        </div>

        <button  class="w-full py-3 bg-purple-700 text-white rounded-lg font-medium hover:bg-purple-800 transition-colors mt-6">Signup</button>

        <p class="text-center text-sm text-gray-600 mt-4">
          Already have an account? <RouterLink to="/login" class="text-blue-600 hover:underline">Login</RouterLink>
        </p>
      </form>
    </div>
  </div>
</template>

