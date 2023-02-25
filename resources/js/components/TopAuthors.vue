<script setup>
    import NavigationBar from './NavigationBar.vue'

    const props = defineProps({
        authors: {
            type: Object,
            required: true
        }
    })
</script>

<template>
  <div class="sticky top-0 flex flex-col">
    <div class="bg-white shadow lg:order-first order-last">
      <div class="px-6 py-3 flex justify-center items-center border-b border-slate-200">
        <p class="text-base">
          Top 3 authors in the last week
        </p>
      </div>
      <div class="p-6 text-sm">
        <router-link
          v-for="(author, index) in authors"
          :key="author.id"
          :to="{ name: 'authorArticles', params: { authorId: author.id } }"
          class="flex justify-center items-center border-green-500 p-3 mb-2 hover:underline"
          :class="{'border-b': index < 2}"
        >
          <p>{{ index + 1 }}. {{ author.name }} <span class="text-xs text-gray-800">({{ author.articles_count }} articles)</span></p>
        </router-link>
      </div>
    </div>

    <NavigationBar />
  </div>
</template>
