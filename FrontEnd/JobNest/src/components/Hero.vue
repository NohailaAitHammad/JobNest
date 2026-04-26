<script setup>
import { defineProps } from 'vue';

defineProps({
  title: {
    type : String,
    default : "Become JobNest"
  },
  subTitle : {
    type : String,
    default : "JobNest reimagines recruitment by shifting the focus to candidates. Create your professional profile, highlight your strengths, and let companies reach out to you"
  }
})
</script>

<template>
  <section class="px-8 py-16 max-w-7xl mx-auto grid grid-cols-2 gap-12 items-center">
    <div>
      <h1 class="text-5xl font-bold leading-tight mb-6">Because Your <span class="text-purple-700">Talent</span><br>Deserves to Be <span class="text-purple-700">Seen</span>.</h1>
      <h1 class="text-5xl font-bold leading-tight mb-6">{{ title }}</h1>
      <p class="text-gray-600 text-lg mb-8 leading-relaxed">{{ subTitle}}</p>
      <div class="flex gap-4">
        <router-link to="/candidats/signUpCandidat" class="px-8 py-3 border border-purple-700 text-purple-700 rounded-lg font-medium hover:bg-purple-50 transition-colors">Candidat</router-link>
        <router-link to="/recruteurs/sigUpRecruteur" class="px-8 py-3 border border-purple-700 text-purple-700 rounded-lg font-medium hover:bg-purple-50 transition-colors">Recruteur</router-link>
      </div>
    </div>
    <div class="relative">
      <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop" alt="Team collaboration" class="rounded-2xl shadow-2xl">
      <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-purple-100 rounded-full opacity-50"></div>
    </div>
  </section>

</template>
