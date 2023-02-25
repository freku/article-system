<script setup>
import { watch, ref, onMounted } from "vue";

const props = defineProps({
  modelValue: {
    type: String,
    required: true,
  },
  placeholder: {
    type: String,
    default: "",
  },
});

defineEmits(["update:modelValue"]);

const textarea = ref(null);
const height = ref(null);

const adjustHeight = () => {
  const textareaEl = textarea.value;

  if (textareaEl) {
    textareaEl.style.height = "auto";
    textareaEl.style.height = `${textareaEl.scrollHeight}px`;
    height.value = textareaEl.scrollHeight;
  }
};

watch(
  () => props.modelValue,
  () => {
    adjustHeight();
  }
);

onMounted(() => adjustHeight());
</script>

<template>
  <textarea
    ref="textarea"
    :value="modelValue"
    :placeholder="placeholder"
    class="w-full text-sm placeholder-gray-500"
    :style="{ height: `${height}px` }"
    @input="$emit('update:modelValue', $event)"
  >
    <slot/>
  </textarea>
</template>
