<script setup>

</script>

<template>

  <!-- Hero Section with Cards -->
  <div class="hero-bg text-white py-16 px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 transform hover:scale-105 transition-transform cursor-pointer">
        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-2xl">
          <i class="fas fa-search"></i>
        </div>
        <div>
          <h3 class="text-2xl font-bold text-purple-800">Search Candidates</h3>
          <p class="text-sm text-purple-600 mt-1">Find profiles that match your needs.</p>
        </div>
      </div>

      <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 transform hover:scale-105 transition-transform cursor-pointer">
        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-2xl">
          <i class="fas fa-file-alt"></i>
        </div>
        <div>
          <h3 class="text-2xl font-bold text-purple-800">My Proposals</h3>
          <p class="text-sm text-purple-600 mt-1">Track the status of your sent proposals.</p>
        </div>
      </div>

      <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 transform hover:scale-105 transition-transform cursor-pointer">
        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-2xl">
          <i class="fas fa-users"></i>
        </div>
        <div>
          <h3 class="text-2xl font-bold text-purple-800">Company Profile</h3>
          <p class="text-sm text-purple-600 mt-1">Manage your company information.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Section -->
  <div class="px-8 py-12 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center gap-4">
        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
          <i class="fas fa-users"></i>
        </div>
        <div>
          <div class="text-3xl font-bold text-purple-800">20</div>
          <div class="text-sm text-purple-600">Available Profiles</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center gap-4">
        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
          <i class="fas fa-file-alt"></i>
        </div>
        <div>
          <div class="text-3xl font-bold text-purple-800">5</div>
          <div class="text-sm text-purple-600">Sent Proposals</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center gap-4">
        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
          <i class="fas fa-clock"></i>
        </div>
        <div>
          <div class="text-3xl font-bold text-purple-800">4</div>
          <div class="text-sm text-purple-600">Pending Proposals</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center gap-4">
        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
          <i class="fas fa-check-circle"></i>
        </div>
        <div>
          <div class="text-3xl font-bold text-purple-800">12</div>
          <div class="text-sm text-purple-600">Accepted Proposals</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Proposals -->
  <div class="px-8 pb-16 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold text-purple-800">Recent Proposals</h2>
      <a href="proposals.html" class="text-sm text-purple-700 hover:underline flex items-center gap-1">See more <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="space-y-4">
      <!-- Proposal 1 -->
      <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center hover:shadow-md transition-shadow">
        <div>
          <h3 class="text-xl font-bold mb-1">UI/UX Designer for Mobile App</h3>
          <p class="text-gray-600 text-sm mb-2">BoldTech Inc.</p>
          <p class="text-gray-500 text-sm mb-3">March 15, 2025</p>
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
            <span class="text-blue-600 font-medium text-sm">Pending</span>
          </div>
        </div>
        <div class="flex gap-3">
          <button class="p-2 text-gray-400 hover:text-blue-600"><i class="fas fa-edit"></i></button>
          <button class="p-2 text-gray-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
          <button class="p-2 text-gray-400 hover:text-purple-600"><i class="fas fa-external-link-alt"></i></button>
        </div>
      </div>

      <!-- Proposal 2 -->
      <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center hover:shadow-md transition-shadow">
        <div>
          <h3 class="text-xl font-bold mb-1">Graphic Designer for Marketing Campaign</h3>
          <p class="text-gray-600 text-sm mb-2">Creative Minds Co.</p>
          <p class="text-gray-500 text-sm mb-3">April 5, 2025</p>
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
            <span class="text-green-600 font-medium text-sm">Accepted</span>
          </div>
        </div>
        <div class="flex gap-3">
          <button class="p-2 text-gray-400 hover:text-purple-600"><i class="fas fa-external-link-alt"></i></button>
        </div>
      </div>

      <!-- Proposal 3 -->
      <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center hover:shadow-md transition-shadow">
        <div>
          <h3 class="text-xl font-bold mb-1">Frontend Developer for Fintech App</h3>
          <p class="text-gray-600 text-sm mb-2">FinanceHub Inc.</p>
          <p class="text-gray-500 text-sm mb-3">April 15, 2025</p>
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
            <span class="text-green-600 font-medium text-sm">Accepted</span>
          </div>
        </div>
        <div class="flex gap-3">
          <button class="p-2 text-gray-400 hover:text-purple-600"><i class="fas fa-external-link-alt"></i></button>
        </div>
      </div>

      <!-- Proposal 4 -->
      <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center hover:shadow-md transition-shadow">
        <div>
          <h3 class="text-xl font-bold mb-1">Data Analyst for Retail Analytics</h3>
          <p class="text-gray-600 text-sm mb-2">Insightful Data Corp.</p>
          <p class="text-gray-500 text-sm mb-3">March 30, 2025</p>
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 bg-red-500 rounded-full"></span>
            <span class="text-red-600 font-medium text-sm">Rejected</span>
          </div>
        </div>
        <div class="flex gap-3">
          <button class="p-2 text-gray-400 hover:text-purple-600"><i class="fas fa-external-link-alt"></i></button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
