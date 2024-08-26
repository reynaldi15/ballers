<template>
  <div class="mt-20 space-y-10 min-h-[60vh]">
    <BaseSectionTitle first-label="History" second-label="Order" />

    <UCard>
      <UTable :rows="data?.data" :columns :ui>
        <template #id-data="{ row }">
          ORDER-{{ row.id }}
        </template>
        <template #created_at-data="{ row }">
          {{ formatReadableDate(row.created_at) }}
        </template>
        <template #price-data="{ row }">
          {{ formatCurrency(row.payment.venue.price) }}
        </template>
        <template #action-data="{ row }">
          <UButton
            color="blue"
            :to="`/dashboard/history/${row.id}`"
            size="lg"
            class="rounded-lg px-10"
          >
            Detail
          </UButton>
        </template>
      </UTable>
    </UCard>
  </div>
</template>

<script setup>
import { useQuery } from "@tanstack/vue-query";
import { getHistories } from "~/services/historyService";

definePageMeta({
  middleware: 'is-logged-in',
});

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
    key: "created_at",
    label: "Date",
  },
  {
    key: "price",
    label: "Price",
  },
  {
    key: "action",
    label: "Action",
  },
];

const { run } = getHistories();
const { data } = useQuery({
  queryKey: ["history"],
  queryFn: run,
});
</script>
