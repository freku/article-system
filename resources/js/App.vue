<script setup>
import SuccessToast from "./components/toasts/SuccessToast.vue";
import DangerToast from "./components/toasts/DangerToast.vue";
</script>

<template>
  <div>
    <SuccessToast />
    <DangerToast />

    <router-view />
  </div>
</template>

<style>
body {
  background: #fcfcfc;
  color: #222222;
}
</style>
