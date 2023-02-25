<script setup>
import NavigationBar from '../NavigationBar.vue'
import LoadingSpinner from '../LoadingSpinner.vue'

const props = defineProps({
    articleFetched: {
        type: Boolean,
        required: true,
    }
})
</script>

<template>
  <div>
    <div
      v-if="!articleFetched"
      class="container flex justify-center mx-auto mt-16"
    >
      <LoadingSpinner classes="w-20 h-20" />
    </div>
    <div
      v-else
      class="container mx-auto my-16 px-6 flex flex-col relative"
    >
      <NavigationBar />

      <slot />
    </div>
  </div>
</template>
