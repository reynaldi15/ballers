<template>
  <NuxtLink
    class="text-gray-800 transition-colors duration-150 hover:text-gray-950"
    :to="link"
  >
    {{ label }}
  </NuxtLink>
</template>

<script setup>
defineProps({
  label: String,
  link: String,
});
</script>
