<template>
  <div class="mt-20 space-y-10 min-h-[60vh]">
    <div class="flex gap-2 items-center">
      <BaseSectionTitle with-back first-label="Detail history" second-label="Order" />
    </div>

    <UCard>
      <UTable :rows="data" :columns :ui>
        <template #date-data="{ row }">
          {{ formatReadableDate(row.created_at) }}
        </template>
        <template #price-data="{ row }">
          {{ formatCurrency(row.payment.venue.price) }}
        </template>
        <template #time-data="{ row }">
          {{ row.payment.venue.start_time }} - {{ row.payment.venue.end_time }}
        </template>
        <template #address-data="{ row }">
          {{ row.payment.venue.address }}
        </template>
        <template #image-data="{ row }">
          <img :src="row.payment.image" class="w-full h-20 rounded object-cover" />
        </template>
      </UTable>
    </UCard>
  </div>
</template>

<script setup>
import { useQuery } from '@tanstack/vue-query';
import { getHistory } from '~/services/historyService';

definePageMeta({
  middleware: 'is-logged-in',
});

const { params } = useRoute();

const ui = {
  base: "border",
  th: { base: "border text-center" },
  td: { base: "border text-center" },
};

const columns = [
    {
      key: "id",
      label: "Order",
    },
    {
      key: "date",
      label: "Date",
    },
    {
      key: "price",
      label: "Price",
    },
    {
      key: "time",
      label: "Time",
    },
    {
      key: "address",
      label: "Location",
    },
    {
      key: "image",
      label: "Image",
    },
];


const { uri, run } = getHistory();
uri.value.orderHistoryId = params.uid;
const { data } = useQuery({
  queryKey: ["history", uri.value],
  queryFn: async () => {
    const res = await run();
    return [res.data];
  },
});
</script>
