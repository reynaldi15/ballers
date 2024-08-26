import { number, object, string } from "yup";

const {
  public: { baseApi },
} = useRuntimeConfig();

export const postPayment = () => {
  const { user } = useAuthStore();
  const body = ref({
    basketball_field_id: null,
    date: formatInputDate(new Date()),
    image: null,
  });

  const validation = object({
    basketball_field_id: number().required("Basketball id wajib Diisi"),
  });

  const run = async () => {
    const form = new FormData();
    form.append("basketball_field_id", body.value.basketball_field_id);
    form.append("date", body.value.date);
    form.append("image", body.value.image);

    const res = await $fetch(`${baseApi}/basketballField/paymentPost`, {
      method: "post",
      body: form,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    console.log(form);
    if (res) return res;
    throw new Error("Payment error");
  };

  return { body, validation, run };
};