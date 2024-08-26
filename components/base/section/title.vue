<template>
  <div>
    <div
      v-if="withBack"
      class="cursor-pointer text-secondary font-bold"
      @click="back"
    >
      Back
    </div>
    <div class="flex gap-2 items-center mt-1">
      <div class="font-bold text-xl text-main">{{ firstLabel }}</div>
      <div class="font-bold text-xl text-secondary">{{ secondLabel }}</div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  firstLabel: String,
  secondLabel: String,
  withBack: Boolean,
});

const { back } = useRouter();
</script>
