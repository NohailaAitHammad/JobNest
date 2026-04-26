<script setup>
defineProps({
  imageURL : String
})
</script>

<template>

  <div class="hidden lg:block">
    <img :src="imageURL" alt="Signup illustration" class="w-full rounded-2xl">
  </div>
</template>

<style scoped>

</style>
