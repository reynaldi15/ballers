<template>
  <div class="mt-10">
    <UCard>
      <BaseSectionTitle with-back first-label="Create" second-label="User" />
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
        <UFormGroup label="Password" name="password">
          <UInput
            :disabled="isPending"
            type="password"
            v-model="state.password"
          />
        </UFormGroup>
        <UFormGroup label="Confirm Password" name="confirm_password">
          <UInput
            :disabled="isPending"
            type="password"
            v-model="state.confirm_password"
          />
        </UFormGroup>
        <UButton type="submit" :loading="isPending"> Submit </UButton>
      </UForm>
    </UCard>
  </div>
</template>

<script setup>
import { useMutation, useQueryClient } from "@tanstack/vue-query";
import { postRegister } from "~/services/authService";

definePageMeta({
  middleware: 'is-logged-in',
});

const { push } = useRouter();
const toast = useToast();
const queryClient = useQueryClient();

const { body: state, validation: schema, run } = postRegister();
const { mutate, isPending } = useMutation({
  mutationFn: run,
  onSuccess: () => {
    toast.add({ title: "User berhasil dibuat" });
    queryClient.invalidateQueries({ queryKey: ["user"] });
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
