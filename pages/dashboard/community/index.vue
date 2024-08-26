<template>
  <div class="mt-20 space-y-10">
    <div class="w-[50%]">
      <div class="flex items-center justify-between">
        <BaseSectionTitle first-label="Join Our" second-label="Community" />
        <UButton
          color="secondary"
          to="/dashboard/community/create"
          class="rounded-full px-3"
        >
          Create Community
        </UButton>
      </div>

      <div class="space-y-8 mt-10">
        <CommunityCard
          v-for="(community, index) in data?.data"
          :key="index"
          v-bind="community"
        />
      </div>
    </div>
    <div class="w-full flex items-center justify-center">
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
import { getCommunities } from "~/services/communityService";

definePageMeta({
  middleware: 'is-logged-in',
});

const { params, run } = getCommunities();
const { data } = useQuery({
  queryKey: ["community", params.value],
  queryFn: run,
});
</script>
