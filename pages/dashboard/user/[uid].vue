<template>
  <div class="mt-10">
    <UCard>
      <BaseSectionTitle with-back first-label="Edit" second-label="User" />
      <UForm :state :schema @submit="mutate" class="space-y-4">
        <UFormGroup label="Name" name="name">
          <UInput :disabled="isPending" type="name" v-model="state.name" />
        </UFormGroup>
        <UFormGroup label="Email" name="email">
          <UInput :disabled="isPending" type="email" v-model="state.email" />
        </UFormGroup>
        <UFormGroup label="Phone" name="phoneNumber">
          <UInput
            :disabled="isPending"
            type="tel"
            v-model="state.phoneNumber"
          />
        </UFormGroup>
        <UFormGroup label="Alamat" name="address">
          <UTextarea :disabled="isPending" v-model="state.address" />
        </UFormGroup>
        <UFormGroup label="Role" name="role_id">
          <USelect
            :disabled="isPending"
            placeholder="Pilih Role"
            :options="roleOptions"
            v-model="state.role_id"
          />
        </UFormGroup>
        <UButton type="submit" :loading="isPending"> Submit </UButton>
      </UForm>
    </UCard>
  </div>
</template>

<script setup>
import { useMutation, useQuery, useQueryClient } from "@tanstack/vue-query";
import { getUser, patchProfile } from "~/services/userService";

definePageMeta({
  middleware: 'is-logged-in',
});

const { push, currentRoute } = useRouter();
const toast = useToast();
const queryClient = useQueryClient();

const { run, uri } = getUser();
uri.value.userId = currentRoute.value.params.uid;
useQuery({
  staleTime: 0,
  queryKey: ["users", uri.value],
  queryFn: async () => {
    const res = await run();

    state.value.role_id = res.data.role.id;
    state.value.name = res.data.name;
    state.value.address = res.data.address;
    state.value.phoneNumber = res.data.phone;
    state.value.email = res.data.email;

    return res;
  },
});

const { uri: updateProfileUri, body: state, validation: schema, run: fetchPatchProfile } = patchProfile();
updateProfileUri.value.userId = currentRoute.value.params.uid;
const { mutate, isPending } = useMutation({
  mutationFn: fetchPatchProfile,
  onSuccess: async () => {
    toast.add({ title: "User berhasil diupdate" });
    queryClient.invalidateQueries({ queryKey: ["users"] });
    push("/dashboard/user");
  },
});

const roleOptions = [
  {
    label: "Admin",
    value: 1,
  },
  {
    label: "Buyer",
    value: 2,
  },
  {
    label: "Seller",
    value: 3,
  },
];
</script>
