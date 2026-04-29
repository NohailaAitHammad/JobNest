<script setup>


</script>

<template>

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
        Already have an account? <router-link to="/login" class="text-blue-600 hover:underline">Login</router-link>
      </p>
</template>

<style scoped>

</style>
