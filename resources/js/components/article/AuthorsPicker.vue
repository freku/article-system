<script setup>
import { ref, computed } from "vue";

const props = defineProps({
  authors: {
    type: Array,
    required: true,
  },
  allAuthors: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits(['addAuthor', 'removeAuthor'])

const showAuthorsSelect = ref(false);
const selectedAuthors = ref([]);

const handleAddButtonClick = () => {
  if (showAuthorsSelect.value) {
    const authorsToAdd = toPickAuthors.value.filter((author) =>
      selectedAuthors.value.includes(author.id)
    )

    authorsToAdd.forEach(author => emit('addAuthor', author));

    showAuthorsSelect.value = false
  } else {
    showAuthorsSelect.value = true;
  }
};

const toPickAuthors = computed(() => {
  return props.allAuthors.filter(
    (allAuthor) =>
      props.authors.findIndex((author) => author.id == allAuthor.id) == -1
  );
});

</script>

<template>
  <div class="text-xs relative">
    <button
      class="text-sm px-2 w-16 underline disabled:opacity-50 disabled:cursor-not-allowed"
      :disabled="!toPickAuthors.length"
      @click="handleAddButtonClick"
    >
      {{ showAuthorsSelect ? 'Add' : 'Authors' }}
    </button>
    <span
      v-for="author in props.authors"
      :key="author.id"
      class="text-slate-500 author-item cursor-pointer"
    >
      <span
        class="hover:text-red-400 hover:curosr"
        @click="emit('removeAuthor', author)"
      >[X] {{ author.name }}</span>
    </span>

    <div
      v-show="showAuthorsSelect"
      class="absolute left-0 bottom-10"
    >
      <div class="text-slate-700 flex justify-between p-2 border bg-slate-100">
        <p>Authors:</p>
        <span
          class="flex justify-center items-center text-white w-4 h-4 bg-red-400 hover:cursor-pointer hover:bg-red-500"
          @click="showAuthorsSelect = false"
        >X</span>
      </div>
      <select
        v-model="selectedAuthors"
        multiple
        class="border"
      >
        <option
          v-for="author in toPickAuthors"
          :key="author.id"
          :value="author.id"
          class="border-b px-2 py-1"
        >
          {{ author.name }}
        </option>
      </select>
    </div>
  </div>
</template>

<style>
.author-item + .author-item::before {
    content: ", ";
}
</style>
