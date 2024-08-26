<template>
  <div>
    <div class="font-bold text-xl">Detail Payment</div>
    <UForm :state :schema @submit="mutate">
      <div class="flex gap-8 mt-2">
        <div class="basis-2/6">
          <div class="space-y-4">
            <UFormGroup label="Nama Venue" name="name_venue">
              <UInput disabled :value="data?.data.title" />
            </UFormGroup>
            <UFormGroup label="Location" name="address">
              <UTextarea disabled :value="data?.data.address" />
            </UFormGroup>
            <UFormGroup label="Time" name="time">
              <UInput
                disabled
                type="text"
                :value="`${data?.data.start_time} - ${data?.data.end_time}`"
              />
            </UFormGroup>
            <UFormGroup label="Day" name="date">
              <UInput disabled v-model="state.date" type="date" />
            </UFormGroup>
            <UFormGroup label="Price" name="price">
              <UInput disabled :value="formatCurrency(data?.data.price)" />
            </UFormGroup>
            <UFormGroup label="Image" name="image">
              <UInput
                type="file"
                accept="image/*"
                required
                v-model="state.image"
                @change="uploadHandler"
              />
            </UFormGroup>
          </div>
        </div>
        <div class="basis-4/6">
          <div
            ref="imageDisplayRef"
            class="bg-gray-300 rounded py-36 flex justify-center items-center w-full"
          ></div>
          <div class="flex justify-end mt-3 text-gray-600">
            Transfer (NOREK OWNER)
          </div>
        </div>
      </div>
      <div class="w-[50vw] mx-auto mt-10">
        <UButton
          type="submit"
          :loading="isPending"
          color="secondary"
          class="font-bold text-white text-2xl w-full py-5 rounded-3xl"
        >
          <div class="flex items-center justify-center w-full">Checkout</div>
        </UButton>
      </div>
    </UForm>
  </div>
</template>

<script setup>
import { useMutation, useQuery, useQueryClient } from "@tanstack/vue-query";
import { getVenue } from "~/services/venueService";
import { postPayment } from "../../../../services/paymentService";

definePageMeta({
  middleware: 'is-logged-in',
});

const { push, currentRoute } = useRouter();
const toast = useToast();
const queryClient = useQueryClient();

const {
  body: state,
  validation: schema,
  run: fetchCreatePayment,
} = postPayment();
const { mutate, isPending } = useMutation({
  mutationFn: fetchCreatePayment,
  onSuccess: () => {
    toast.add({ title: "Pembayaran telah dibuat" });
    queryClient.invalidateQueries({ queryKey: ["payment"] });
    push("/dashboard");
  },
});

const { uri, run } = getVenue();
uri.value.userId = currentRoute.value.params.uid;
const { data } = useQuery({
  staleTime: 0,
  queryKey: ["venue", uri.value],
  queryFn: async () => {
    const res = await run();
    state.value.basketball_field_id = res.data.id;
    return res;
  },
});

const imageDisplayRef = ref();
const uploadHandler = (e) => {
  state.value.image = e[0];
  const fileUrl = convertFileToUrl(e[0]);
  imageDisplayRef.value.style = `background: url(${fileUrl}) no-repeat center center; background-size: cover;`;
};
</script>
