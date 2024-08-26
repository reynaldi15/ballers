<template>
  <div class="flex flex-col justify-center items-center w-full h-screen gap-7">
    <img src="~/assets/logo.svg" alt="Logo" />
    <UCard class="w-[35%]">
      <UForm :state :schema @submit="mutate" class="space-y-4">
        <UFormGroup label="Email" name="email">
          <UInput :disabled="isPending" type="email" v-model="state.email" />
        </UFormGroup>
        <UFormGroup label="Password" name="password">
          <UInput
            :disabled="isPending"
            type="password"
            v-model="state.password"
          />
        </UFormGroup>
        <UCheckbox
          v-model="state.remember_me"
          name="remember_me"
          label="Remember Me"
        />
        <div class="mt-2 grid grid-cols-3">
          <UButton variant="link" to="/register">
            You don't have an account?
          </UButton>
          <UButton variant="link">Forgot your password?</UButton>
          <UButton type="submit" :loading="isPending">
            <div class="flex justify-center w-full">Log in</div>
          </UButton>
        </div>
      </UForm>
    </UCard>
  </div>
</template>

<script setup>
import { useMutation, useQueryClient } from "@tanstack/vue-query";
import { postLogin } from "~/services/authService";

definePageMeta({
  layout: "blank",
  middleware: "is-unauthenticated",
});

const router = useRouter();
const authStore = useAuthStore();
const queryClient = useQueryClient();

const {
  body: state,
  validation: schema,
  run
} = postLogin();

const { mutate, isPending } = useMutation({
  mutationFn: run,
  onSuccess: (data) => {
    authStore.setUser(data);
    queryClient.invalidateQueries();

    if (authStore.isAdmin()) {
      router.push("/dashboard/user");
    }

    if (authStore.isSeller()) {
      router.push("/dashboard/venue");
    }

    if (authStore.isBuyer()) {
      router.push("/dashboard");
    }
  },
});
</script>
