<template>
  <div class="space-y-10">
    <div class="cursor-pointer text-secondary font-bold text-xl py-2" @click="back">
      Back
    </div>
    <img
      :src="data?.data.image"
      alt=""
      class="w-full h-40 object-cover rounded"
    />
    <div>
      <div class="font-bold">{{ data?.data.title }}</div>
      <div class="text-secondary">{{ data?.data.address }}</div>
      <div>
        <span class="text-tertiary">{{
          formatCurrency(data?.data.price)
        }}</span>
        <span class="text-xs ml-1">on</span>
        {{ data?.data.start_time }} - {{ data?.data.end_time }}
        <span class="text-xs"
          >in {{ formatReadableDate(data?.data.date) }}</span
        >
      </div>
    </div>
    <div>
      <div class="font-bold text-xl">Description</div>
      <p class="mt-2">{{ data?.data.desc }}</p>
    </div>
    <div class="w-[50vw] mx-auto">
      <UButton
        color="secondary"
        class="font-bold text-white text-2xl w-full py-5 rounded-3xl"
        :to="`/dashboard/venue/${params.uid}/payment`"
      >
        <div class="flex items-center justify-center w-full">Go to Payment</div>
      </UButton>
    </div>
  </div>
</template>

<script setup>
import { useQuery } from "@tanstack/vue-query";
import { getVenue } from "~/services/venueService";

definePageMeta({
  middleware: "is-logged-in",
});

const { params } = useRoute();
const { back } = useRouter();

const { uri, run } = getVenue();
uri.value.userId = params.uid;
const { data } = useQuery({
  staleTime: 0,
  queryKey: ["venue", uri.value],
  queryFn: run,
});
</script>
