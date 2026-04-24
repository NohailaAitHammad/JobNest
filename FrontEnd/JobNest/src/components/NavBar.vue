<script setup>

</script>

<template>

  <nav class="flex justify-between bg-gray-100 items-center px-8 py-6 max-w-7xl mx-auto">
    <div class="flex items-center gap-2">
      <div class="w-10 h-10 bg-purple-700 rounded-lg flex items-center justify-center text-white font-bold text-2xl">J</div>
    </div>
    <div class="flex items-center gap-6">
      <div class="relative">
        <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-80 focus:outline-none focus:border-purple-600">
        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
      </div>
      <a href="login.html" class="px-6 py-2 border border-purple-700 text-purple-700 rounded-lg hover:bg-purple-50 transition-colors">Login</a>
      <a href="signup-talent.html" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors">Sign Up</a>
    </div>
  </nav>

</template>
