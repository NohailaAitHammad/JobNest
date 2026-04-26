<script setup>

import Form from "@/components/Form.vue";
import Image from "@/components/Image.vue";

defineProps({
  imageURL : String,
  User : String,
  pageName : String,

})
</script>

<template>
  <div  class="bg-white min-h-screen flex items-center justify-center illustration-bg">
      <div class="w-full max-w-6xl grid grid-cols-2 gap-12 items-center p-8">
      <Image :imageURL="imageURL" />
    <div class="max-w-md mx-auto w-full">
      <h1 class="text-4xl font-bold text-center mb-8">{{ pageName}}</h1>

      <div class="flex gap-8 mb-8 border-b border-gray-200">
        <button class="pb-2 border-b-2 border-purple-700 text-purple-700 font-medium">{{ User}}</button>
      </div>
      <slot></slot>
    </div>

  </div>

  </div>

</template>

<style scoped>

</style>
