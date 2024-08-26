<template>
  <div class="flex flex-col justify-center items-center w-full gap-7 py-10">
    <img src="~/assets/logo.svg" alt="Logo" />
    <UCard class="w-[35%]">
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
        <div class="mt-2 flex justify-end gap-3">
          <UButton variant="link" to="/" :disabled="isPending">
            Already Registered?
          </UButton>
          <UButton type="submit" :loading="isPending"> Register </UButton>
        </div>
      </UForm>
    </UCard>
  </div>
</template>

<script setup>
import { useMutation } from "@tanstack/vue-query";
import { postRegister } from "~/services/authService";

definePageMeta({
  layout: "blank",
  middleware: "is-unauthenticated",
});

const router = useRouter();
const toast = useToast();

const { body: state, validation: schema, run } = postRegister();
const { mutate, isPending } = useMutation({
  mutationFn: run,
  onSuccess: () => {
    toast.add({
      title: "Register Success",
      description: "Akun anda telah dibuat.",
    });

    router.push("/");
  },
});

const roleOptions = [
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
