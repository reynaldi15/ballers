<template>
  <div class="mt-10">
    <BaseSectionTitle with-back first-label="Create" second-label="Community" />

    <UForm :state :schema @submit="mutate" class="space-y-4 mt-4">
      <UFormGroup label="Nama Komunitas" name="name">
        <UInput v-model="state.name" />
      </UFormGroup>
      <UFormGroup label="Gambar Komunitas" name="image">
        <UInput
          type="file"
          accept="image/png,image/jpg,image/jpeg"
          v-model="state.image"
          @change="uploadHandler"
        />
      </UFormGroup>
      <UFormGroup label="Alamat" name="address">
        <UTextarea v-model="state.address" />
      </UFormGroup>
      <UFormGroup label="Deskripsi" name="desc">
        <UTextarea v-model="state.desc" />
      </UFormGroup>
      <UFormGroup label="Nomor Telepon" name="phone">
        <UInput type="tel" v-model="state.phone" />
      </UFormGroup>

      <div class="mt-10">
        <UButton type="submit" color="secondary" class="rounded-lg px-6"
          >Create</UButton
        >
      </div>
    </UForm>
  </div>
</template>

<script setup>
import { useMutation, useQueryClient } from "@tanstack/vue-query";
import { postCommunity } from "~/services/communityService";

definePageMeta({
  middleware: 'is-logged-in',
});

const { push } = useRouter();
const toast = useToast();
const queryClient = useQueryClient();

const { body: state, validation: schema, run } = postCommunity();
const { mutate } = useMutation({
  mutationFn: run,
  onSuccess: () => {
    toast.add({ title: "Komunitas berhasil dibuat" });
    queryClient.invalidateQueries({ queryKey: ["community"] });
    push("/dashboard/community");
  },
});

const uploadHandler = (e) => (state.value.image = e[0]);
</script>
