<template>
  <div class="space-y-6">
    <div
      class="bg-gray-300 rounded py-20 flex justify-center items-center bg-[url('https://storage.googleapis.com/pod_public/1300/180358.jpg')] bg-cover bg-center"
    ></div>
    <div class="flex justify-between items-center">
      <BaseSectionTitle first-label="Our" second-label="Venue" />

      <!-- <UFormGroup label="Search" name="search" class="w-[30vw]">
        <UInput :disabled="isPending" v-model="tempSearch" />
      </UFormGroup> -->
    </div>

    <div class="grid grid-cols-4 gap-5">
      <ProductCard
        v-for="(product, index) in data?.data"
        :key="index"
        v-bind="product"
        :to="`/dashboard/product/${product.id}`"
      />
    </div>
    <div class="flex items-center justify-center">
      <UPagination
        :total="data?.meta.total"
        :page-count="params.size"
        v-model="params.page"
      />
    </div>
  </div>
</template>

<script setup>
import { useQuery } from "@tanstack/vue-query";
import { getVenues } from "~/services/venueService";

definePageMeta({
  middleware: "is-logged-in",
});

const tempSearch = ref("");

watchDebounced(tempSearch, () => (params.value.search = tempSearch.value), {
  debounce: 1000,
});

const { params, run } = getVenues();
const { data, isPending } = useQuery({
  queryKey: ["venues", params.value],
  queryFn: run,
});
</script>
