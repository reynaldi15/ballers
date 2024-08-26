<template>
  <div class="mt-10">
    <UCard>
      <div class="text-xl font-bold">Profile Information</div>
      <div class="text-gray-500">
        Update your account's profile information and email address
      </div>
      <UForm :state :schema @submit="mutate" class="space-y-4 mt-4">
        <UFormGroup label="Nama" name="name">
          <UInput v-model="state.name" />
        </UFormGroup>
        <UFormGroup label="Email" name="email">
          <UInput type="email" v-model="state.email" />
        </UFormGroup>
        <UFormGroup label="Phone" name="phoneNumber">
          <UInput type="tel" v-model="state.phoneNumber" />
        </UFormGroup>
        <UFormGroup label="Alamat" name="address">
          <UTextarea v-model="state.address" />
        </UFormGroup>

        <div class="mt-10">
          <UButton type="submit" :loading="isPending" class="rounded-lg px-6">
            Submit
          </UButton>
        </div>
      </UForm>
    </UCard>
  </div>
</template>

<script setup>
import { useMutation, useQuery, useQueryClient } from "@tanstack/vue-query";
import { patchProfile, getProfile } from "~/services/userService";

definePageMeta({
  middleware: 'is-logged-in',
});

const { user, setUser } = useAuthStore();
const { push, currentRoute } = useRouter();
const toast = useToast();
const queryClient = useQueryClient();

const { run } = getProfile();
const { data, refetch } = useQuery({
  enabled: false,
  queryKey: ["profile"],
  queryFn: run,
});

const { uri, body: state, validation: schema, run: fetchPatchProfile } = patchProfile();
uri.value.userId = user.id
state.value.address = user.address;
state.value.email = user.email;
state.value.name = user.name;
state.value.phoneNumber = user.phoneNumber;
state.value.role_id = user.role.id;
const { mutate, isPending } = useMutation({
  mutationFn: fetchPatchProfile,
  onSuccess: async () => {
    toast.add({ title: "Profile berhasil diupdate" });
    await refetch();
    setUser(data.value);
    queryClient.invalidateQueries({ queryKey: ["profile"] });
    push("/dashboard/account");
  },
});
</script>
