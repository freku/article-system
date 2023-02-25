<script setup>
import TextareaAutoHeight from '../TextareaAutoHeight.vue';
import AuthorsPicker from './AuthorsPicker.vue';

const props = defineProps({
    cancelText: {
        type: String,
        required: true,
    },
    saveText: {
        type: String,
        required: true,
    },
    article: {
        type: Object,
        required: true,
    },
    authors: {
        type: Array,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    content: {
        type: String,
        required: true,
    },
})

const emit = defineEmits(['save', 'cancel', 'removeAuthor', 'addAuthor', 'update:title', 'update:content'])

</script>

<template>
  <div class="bg-white block shadow-md mb-6 md:mx-20 transition-shadow">
    <div class="flex items-center border-b border-slate-200 px-6 py-4">
      <TextareaAutoHeight
        :model-value="title"
        placeholder="Title of article"
        class="w-full text-xl font-medium"
        @update:modelValue="$emit('update:title', $event.target.value)"
      />
    </div>
    <div class="flex items-center py-4 px-6">
      <TextareaAutoHeight
        :model-value="content"
        placeholder="Content of article"
        class="w-full text-sm"
        @update:modelValue="$emit('update:content', $event.target.value)"
      />
    </div>
    <div class="px-6 py-2 flex justify-between lg:flex-row flex-col">
      <AuthorsPicker
        :authors="article.authors"
        :all-authors="authors"
        @add-author="emit('addAuthor', $event)"
        @remove-author="emit('removeAuthor', $event)"
      />
      <div>
        <button
          class="text-red-400 underline mr-2"
          @click="emit('cancel')"
        >
          {{ cancelText }}
        </button>

        <button
          class="text-green-500 underline"
          @click="emit('save')"
        >
          {{ saveText }}
        </button>
      </div>
    </div>
  </div>
</template>
