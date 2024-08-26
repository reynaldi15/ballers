<template>
  <div class="mt-10">
    <UCard>
      <BaseSectionTitle with-back first-label="Create" second-label="Venue" />
      <UForm :state :schema @submit="mutate" class="space-y-4 mt-4">
        <UFormGroup label="Name Venue" name="title">
          <UInput v-model="state.title" />
        </UFormGroup>
        <UFormGroup label="Image Venue" name="image">
          <UInput
            type="file"
            accept="image/png,image/jpg,image/jpeg"
            @change="uploadHandler"
            v-model="state.image"
          />
        </UFormGroup>
        <UFormGroup label="Harga Venue" name="price">
          <UInput type="number" v-model="state.price" />
        </UFormGroup>
        <UFormGroup label="Alamat" name="address">
          <UTextarea v-model="state.address" />
        </UFormGroup>
        <UFormGroup label="Tanggal Venue" name="date">
          <UInput type="date" v-model="state.date" />
        </UFormGroup>
        <UFormGroup label="Waktu Mulai" name="start_time">
          <UInput type="time" step="any" v-model="state.start_time" />
        </UFormGroup>
        <UFormGroup label="Waktu Berakhir" name="end_time">
          <UInput type="time" step="any" v-model="state.end_time" />
        </UFormGroup>
        <UFormGroup label="Deskripsi" name="desc">
          <UTextarea v-model="state.desc" />
        </UFormGroup>

        <div class="mt-10">
          <UButton
            type="submit"
            :loading="isPending"
            color="secondary"
            class="rounded-lg px-6"
          >
            Create
          </UButton>
        </div>
      </UForm>
    </UCard>
  </div>
</template>

<script setup>
import { useMutation, useQueryClient } from "@tanstack/vue-query";
import { postVenue } from "~/services/venueService";

definePageMeta({
  middleware: 'is-logged-in',
});

const { push } = useRouter();
const toast = useToast();
const queryClient = useQueryClient();

const { body: state, validation: schema, run } = postVenue();
const { mutate, isPending } = useMutation({
  mutationFn: run,
  onSuccess: () => {
    toast.add({ title: "Venue berhasil dibuat" });
    queryClient.invalidateQueries({ queryKey: ["venue"] });
    push("/dashboard/venue");
  },
});

const uploadHandler = (e) => (state.value.image = e[0]);
</script>
