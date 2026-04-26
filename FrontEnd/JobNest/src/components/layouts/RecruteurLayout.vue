<script setup>


import {useStore} from "vuex";
import {useRouter} from "vue-router";
import {computed} from "vue";

const store = useStore();
const router = useRouter();
const user = computed(() => store.state.user.data)
console.log(user.value.image)

const logout = () => {
  store.dispatch('logout')
    .then((response) => {
      router.push({
        name: 'login'
      })
    })
}
</script>

<template>

    <!-- Navigation -->
    <nav class="bg-white shadow-sm px-8 py-4 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-8">
          <div class="w-10 h-10 bg-purple-700 rounded-lg flex items-center justify-center text-white font-bold text-2xl">J</div>
          <div class="hidden md:flex gap-6 text-sm font-medium">
            <a href="#" class="text-purple-700">Dashboard</a>
            <a href="search-talent.html" class="text-gray-600 hover:text-purple-700">Search</a>
            <a href="proposals.html" class="text-gray-600 hover:text-purple-700">My Proposals</a>
          </div>
        </div>
        <div class="flex items-center gap-4">
          <div class="relative hidden md:block">
            <input type="text" placeholder="Search Talent" class="pl-10 pr-4 py-2 border border-purple-200 rounded-lg w-80 focus:outline-none focus:border-purple-600">
            <i class="fas fa-search absolute left-3 top-3 text-purple-600"></i>
          </div>
          <router-link to="/candidats/profileCandidat" class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-600 hover:text-purple-700 transition-colors">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

          </router-link>
          <button class="p-2 text-gray-600 hover:text-purple-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-600 hover:text-purple-700 transition-colors">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
          </button>
          <button @click ="logout" class="bg-red-600 px-4 py-2 rounded-2xl text-amber-50 cursor-pointer ">Log Out</button>
          <router-link to="/recruteurs/profile/4">
            <img src="" class="w-10 h-10 rounded-full border-2 border-purple-200 cursor-pointer" alt="">
          </router-link>
        </div>
      </div>
    </nav>

      <RouterView></RouterView>

    <!-- Footer -->
    <footer class="bg-purple-900 text-white py-12 px-8">
      <div class="max-w-7xl mx-auto grid grid-cols-4 gap-8">
        <div>
          <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-purple-900 font-bold text-2xl mb-4">J</div>
          <p class="text-sm text-purple-200 mb-2">Copyright © 2025 J</p>
          <p class="text-sm text-purple-200">All rights reserved</p>
        </div>
        <div>
          <h4 class="font-bold mb-4">Company</h4>
          <ul class="space-y-2 text-sm text-purple-200">
            <li><a href="#" class="hover:text-white">About us</a></li>
            <li><a href="#" class="hover:text-white">Services</a></li>
            <li><a href="#" class="hover:text-white">Pricing</a></li>
            <li><a href="#" class="hover:text-white">Contact us</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold mb-4">Support</h4>
          <ul class="space-y-2 text-sm text-purple-200">
            <li><a href="#" class="hover:text-white">Help center</a></li>
            <li><a href="#" class="hover:text-white">Terms of service</a></li>
            <li><a href="#" class="hover:text-white">Legal</a></li>
            <li><a href="#" class="hover:text-white">Privacy policy</a></li>
            <li><a href="#" class="hover:text-white">Status</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold mb-4">Legal</h4>
          <ul class="space-y-2 text-sm text-purple-200">
            <li><a href="#" class="hover:text-white">Terms of Service</a></li>
            <li><a href="#" class="hover:text-white">Cookie Policy</a></li>
          </ul>
          <div class="flex gap-4 mt-4">
            <a href="#" class="w-8 h-8 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700"><i class="fab fa-instagram"></i></a>
            <a href="#" class="w-8 h-8 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700"><i class="fab fa-youtube"></i></a>
            <a href="#" class="w-8 h-8 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700"><i class="fab fa-x-twitter"></i></a>
          </div>
        </div>
      </div>
    </footer>
</template>

<style scoped>

</style>
