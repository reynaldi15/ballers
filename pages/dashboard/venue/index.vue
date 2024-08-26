<template>
  <div class="mt-20 space-y-10 min-h-[60vh]">
    <BaseSectionTitle first-label="List" second-label="Venue" />
    <UButton
      color="secondary"
      class="rounded-full"
      to="/dashboard/venue/create"
      label="Create"
    />

    <UTable :rows="data?.data" :columns :ui>
      <template #date-data="{ row }">
        {{ formatReadableDate(row.date) }}
      </template>
      <template #time-data="{ row }">
        {{ row.start_time }} - {{ row.end_time }}
      </template>
      <template #price-data="{ row }">
        {{ formatCurrency(row.price) }}
      </template>
      <template #address-data="{ row }">
        <div class="line-clamp-1">
          {{ row.address }}
        </div>
      </template>
      <template #desc-data="{ row }">
        <div class="line-clamp-1">
          {{ row.desc }}
        </div>
      </template>
      <template #image-data="{ row }">
        <img :src="row.image" class="w-full h-20 rounded object-cover" />
      </template>
      <template #action-data="{ row }">
        <div class="flex flex-col gap-2 justify-start">
          <UButton
            color="yellow"
            :to="`/dashboard/venue/${row.id}`"
            size="lg"
            class="rounded-lg"
          >
            <div class="flex w-full justify-center">
              <UIcon name="i-heroicons-pencil" />
            </div>
          </UButton>
          <UButton
            color="red"
            size="lg"
            class="rounded-lg"
            @click="setDeletePopup(row.id)"
          >
            <div class="flex w-full justify-center">
              <UIcon name="i-heroicons-trash" />
            </div>
          </UButton>
        </div>
      </template>
    </UTable>

    <BaseAlert v-model="popupModel" @submit="removeVenue(selectedDeleteId)" />
  </div>
</template>

<script setup>
import { useMutation, useQuery } from "@tanstack/vue-query";
import { deleteVenue, getSellerVenues } from "~/services/venueService";

definePageMeta({
  middleware: "is-logged-in",
});

const toast = useToast();

const { params, run } = getSellerVenues();
params.value.size = 9999;
const { data, refetch } = useQuery({
  queryKey: ["venues", params.value],
  queryFn: run,
});

const ui = {
  td: { base: "bg-gray-100" },
};

const columns = [
  {
    key: "title",
    label: "Title",
  },
  {
    key: "image",
    label: "Image",
  },
  {
    key: "price",
    label: "Price",
  },
  {
    key: "address",
    label: "Location",
    class: "!w-[5rem]",
  },
  {
    key: "desc",
    label: "Deskripsi",
    class: "!w-[5rem]",
  },
  {
    key: "date",
    label: "Date",
  },
  {
    key: "time",
    label: "Time",
  },
  {
    key: "action",
    label: "Action",
  },
];

const popupModel = ref(false);
const selectedDeleteId = ref();
const setDeletePopup = (id) => {
  selectedDeleteId.value = id;
  popupModel.value = true;
};

const { uri, run: fetchDeleteVenue } = deleteVenue();
const { mutate } = useMutation({
  mutationFn: fetchDeleteVenue,
  onSuccess: () => {
    toast.add({ title: "Venue telah dihapus" });
    refetch();
  },
});

const removeVenue = async (id) => {
  uri.value.id = id;
  mutate();
};
</script>
