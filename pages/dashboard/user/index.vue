<template>
  <div class="mt-20 space-y-10 min-h-[60vh]">
    <BaseSectionTitle first-label="List" second-label="User" />
    <UButton
      color="secondary"
      class="rounded-full"
      to="/dashboard/user/create"
      label="Create"
    />

    <UCard>
      <UTable :rows="data?.data" :columns :ui>
        <template #action-data="{ row }">
          <div class="inline-flex flex-col gap-2 justify-start">
            <UButton
              color="yellow"
              :to="`/dashboard/user/${row.id}`"
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
    </UCard>
    <BaseAlert v-model="popupModel" @submit="removeUser(selectedDeleteId)" />
  </div>
</template>

<script setup>
import { useMutation, useQuery } from "@tanstack/vue-query";
import { getHistories } from "~/services/historyService";
import { deleteUser, getUsers } from "~/services/userService";

definePageMeta({
  middleware: "is-logged-in",
});

const toast = useToast();

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

const popupModel = ref(false);
const selectedDeleteId = ref();
const setDeletePopup = (id) => {
  selectedDeleteId.value = id;
  popupModel.value = true;
}

const { run } = getUsers();
const { data, refetch } = useQuery({
  queryKey: ["users"],
  queryFn: run,
});

const { uri, run: fetchDeleteUser } = deleteUser();
const { mutate } = useMutation({
  mutationFn: fetchDeleteUser,
});

const removeUser = async (id) => {
  uri.value.userId = id;
  mutate(null, {
    onSuccess: () => {
      toast.add({ title: "User telah dihapus" });
      refetch();
    },
  });
};
</script>
