<template>
  <NuxtLink :to>
    <UCard :ui="{ shadow: '', ring: '' }">
      <div class="space-y-1">
        <img :src="image" alt="" class="w-full h-40 object-cover rounded" />
        <div class="text-center font-bold">{{ title }}</div>
        <div class="text-gray-600">{{ address }}</div>
        <!-- <div class="text-secondary">{{ lapangan }}</div> -->
        <div>
          <span class="text-tertiary">{{ formatCurrency(price) }}</span>
          <span class="text-xs ml-1">on</span>
          {{ start_time }} - {{ end_time }}
          <span class="text-xs">in {{ formatReadableDate(date) }}</span>
        </div>
      </div>
    </UCard>
  </NuxtLink>
</template>

<script setup>
defineProps({
  user_id: Number,
  title: String,
  image: String,
  price: Number,
  address: String,
  desc: String,
  date: String,
  start_time: String,
  end_time: String,
});
</script>
