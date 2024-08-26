<template>
  <div class="mt-20 space-y-10 min-h-[60vh]">
    <UCard>
      <UTable :rows="data" :columns :ui>
        <template #action-data="{ row }">
          <UButton
            color="yellow"
            :to="`/dashboard/account/edit`"
            size="lg"
            class="rounded-full"
          >
            <div class="flex w-full justify-center">
              <UIcon name="i-heroicons-pencil" />
            </div>
          </UButton>
        </template>
      </UTable>
    </UCard>
  </div>
</template>

<script setup>
import { useQuery } from "@tanstack/vue-query";
import { getProfile } from "~/services/userService";

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
    key: "name",
    label: "Name",
  },
  {
    key: "email",
    label: "Email",
  },
  {
    key: "phone",
    label: "Phone",
  },
  {
    key: "address",
    label: "Alamat",
  },
  {
    key: "action",
    label: "Action",
  },
];

const { run } = getProfile();
const { data } = useQuery({
  staleTime: 0,
  queryKey: ["profile"],
  queryFn: async () => {
    const res = await run();
    return [res.data];
  },
});
</script>
