<script setup>
</script>

<template>
  <div class="flex justify-center p-2">
    <router-link :to="{name: 'home'}">
      <span class="underline text-blue-400 hover:text-blue-500">home</span>
    </router-link>

    <router-link :to="{name: 'createArticle'}">
      <span class="ml-2 underline text-blue-400 hover:text-blue-500">create an article</span>
    </router-link>
  </div>
</template>
