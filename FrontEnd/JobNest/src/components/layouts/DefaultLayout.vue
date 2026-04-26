<script setup>

import Achievement from "@/components/Achievement.vue";
import HowtWorks from "@/components/HowtWorks.vue";
import WhyChooseUs from "@/components/WhyChooseUs.vue";
import NavBar from "@/components/NavBar.vue";
import Hero from "@/components/Hero.vue";
import Foooter from "@/components/ff.vue";
</script>

<template>

  <div class="bg-white text-gray-900">
    <NavBar />
    <RouterView></RouterView>
    <Foooter />
  </div>
</template>

<style scoped>

</style>
