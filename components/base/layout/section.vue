<template>
  <div class="space-y-3 text-ink-900">
    <div class="flex items-center gap-4">
      <hr class="w-10 py-[.15rem] bg-primary max-sm:hidden" />
      <h2 class="text-2xl sm:text-3xl font-bold">{{ title }}</h2>
    </div>
    <p v-if="text" class="text-base sm:text-lg" v-html="text" />
  </div>
</template>

<script setup>
defineProps({
  title: String,
  text: String,
});
</script>
