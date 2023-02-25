import { ref, isRef, unref, watchEffect } from "vue";
import axios from "axios";

export function useFetchWithData(url) {
  const fetched = ref(false);
  const data = ref(null);
  const errors = ref(null);

  async function fetchData() {
    try {
      fetched.value = false;

      const result = await axios.get(unref(url));

      fetched.value = true;
      data.value = result.data.data;
    } catch (errors) {
      errors.value = errors;
    }
  }

  if (isRef(url)) {
    watchEffect(fetchData);
  } else {
    fetchData();
  }

  return {
    fetched,
    data,
    errors,
  };
}
