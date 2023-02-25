<script setup>
const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  content: {
    type: String,
    required: true,
  },
  authors: {
    type: Array,
    required: true,
  },
  articleId: {
    type: Number,
    required: true,
  },
  showHoverEffect: {
    type: Boolean,
    default: false,
  },
  clipContent: {
    type: Boolean,
    default: true,
  },
});
</script>

<template>
  <div
    class="bg-white block shadow-md mb-6 transition-shadow"
    :class="{ 'hover:shadow-lg': showHoverEffect }"
  >
    <div
      class="flex items-center border-b border-slate-200 px-6 py-4"
      :class="{ 'h-20': clipContent }"
    >
      <p
        class="text-xl font-medium"
        :class="{ 'overflow-clip line-clamp-2': clipContent }"
      >
        {{ title }}
      </p>
    </div>
    <div
      class="flex items-center py-4 px-6"
      :class="{ 'h-20': clipContent }"
    >
      <p
        class="text-sm"
        :class="{ 'overflow-clip line-clamp-3': clipContent }"
      >
        {{ content }}
      </p>
    </div>
    <div
      class="px-6 py-2 flex justify-between"
      :class="{ 'h-10': clipContent }"
    >
      <p class="text-xs">
        Authors:
        <router-link
          v-for="author in authors"
          :key="author.id"
          :to="{ name: 'authorArticles', params: { authorId: author.id } }"
          class="text-blue-400 author-item hover:underline"
        >
          <span>{{ author.name }}</span>
        </router-link>
      </p>
      <slot />
    </div>
  </div>
</template>

<style>
.author-item + .author-item::before {
  content: ", ";
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
}
</style>
