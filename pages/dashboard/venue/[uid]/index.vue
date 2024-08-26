<template>
  <div class="mt-10">
    <UCard>
      <BaseSectionTitle with-back first-label="Edit" second-label="Venue" />
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
            Update
          </UButton>
        </div>
      </UForm>
    </UCard>
  </div>
</template>

<script setup>
import { useMutation, useQuery, useQueryClient } from "@tanstack/vue-query";
import { getVenue, patchVenue, postVenue } from "~/services/venueService";

definePageMeta({
  middleware: "is-logged-in",
});

const { push, currentRoute } = useRouter();
const toast = useToast();
const queryClient = useQueryClient();

const { uri, run } = getVenue();
uri.value.userId = currentRoute.value.params.uid;
useQuery({
  staleTime: 0,
  queryKey: ["venue", uri.value],
  queryFn: async () => {
    const res = await run();
    state.value = (({
      title,
      address,
      price,
      date,
      start_time,
      end_time,
      desc,
    }) => ({ title, address, price, date: formatInputDate(date), start_time, end_time, desc }))(
      res.data
    );

    return res;
  },
});

const { uri: patchUri, body: state, validation: schema, run: fetchPatchVenue } = patchVenue();
patchUri.value.userId = currentRoute.value.params.uid;
const { mutate, isPending } = useMutation({
  mutationFn: fetchPatchVenue,
  onSuccess: () => {
    toast.add({ title: "Venue berhasil diupdate" });
    queryClient.invalidateQueries({ queryKey: ["venue"] });
    push("/dashboard/venue");
  },
});

const uploadHandler = (e) => (state.value.image = e[0]);
</script>
