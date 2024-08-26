<template>
  <div class="flex gap-10">
    <img :src="image" class="h-32 w-40 object-cover" />
    <div class="space-y-3">
      <div>
        <div class="font-bold">{{ name }}</div>
        <div class="text-gray-600">{{ address }}</div>
      </div>
      <div class="line-clamp-3">{{ desc }}</div>
      <UButton
        color="lime"
        :to="whatsappLink"
        target="_blank"
        class="px-10 rounded-full text-lime"
      >
        WA
      </UButton>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  id: String,
  name: String,
  phone: String,
  address: String,
  desc: String,
  image: String,
});

const whatsappLink = computed(() => `https://wa.me/${props.phone}`);
</script>
