import { number, object, string } from "yup";

const {
  public: { baseApi },
} = useRuntimeConfig();

export const getSellerVenues = () => {
  const { user } = useAuthStore();

  const params = ref({
    page: 1,
    size: 12,
    search: '',
  });

  const run = async () => {
    const res = await $fetch(`${baseApi}/sellerDashboard`, {
      params: params.value,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("List venue error");
  };

  return { params, run };
};
export const getVenues = () => {
  const { user } = useAuthStore();

  const params = ref({
    page: 1,
    size: 12,
    search: '',
  });

  const run = async () => {
    const res = await $fetch(`${baseApi}/buyerDashboard`, {
      params: params.value,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("List venue error");
  };

  return { params, run };
};

export const postVenue = () => {
  const { user } = useAuthStore();
  const body = ref({
    title: null,
    image: null,
    address: null,
    price: null,
    date: null,
    start_time: null,
    end_time: null,
    desc: null,
  });

  const validation = object({
    title: string().required("Nama Venue wajib Diisi"),
    address: string().required("Alamat wajib Diisi"),
    price: number().required("Harga wajib Diisi"),
    desc: string().required("Deskripsi Diisi"),
    date: string().required("Tanggal wajib Diisi"),
    start_time: string().required("Waktu mulai wajib Diisi"),
    end_time: string().required("Waktu berakhir wajib Diisi"),
  });

  const run = async () => {
    const form = new FormData();
    form.append("title", body.value.title);
    form.append("image", body.value.image);
    form.append("price", body.value.price);
    form.append("address", body.value.address);
    form.append("date", body.value.date);
    form.append("start_time", body.value.start_time);
    form.append("end_time", body.value.end_time);
    form.append("desc", body.value.desc);

    const res = await $fetch(`${baseApi}/BasketballFieldPost`, {
      method: "post",
      body: form,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Create venue error");
  };

  return { body, validation, run };
};

export const patchVenue = () => {
  const { user } = useAuthStore();
  const uri = ref({ userId: null });
  const body = ref({
    title: null,
    image: null,
    address: null,
    price: null,
    date: null,
    start_time: null,
    end_time: null,
    desc: null,
  });

  const validation = object({
    title: string().required("Nama Venue wajib Diisi"),
    address: string().required("Alamat wajib Diisi"),
    price: number().required("Harga wajib Diisi"),
    desc: string().required("Deskripsi Diisi"),
    date: string().required("Tanggal wajib Diisi"),
    start_time: string().required("Waktu mulai wajib Diisi"),
    end_time: string().required("Waktu berakhir wajib Diisi"),
  });

  const run = async () => {
    const form = new FormData();
    form.append("title", body.value.title);
    form.append("image", body.value.image || null);
    form.append("price", body.value.price);
    form.append("address", body.value.address);
    form.append("date", body.value.date);
    form.append("start_time", body.value.start_time);
    form.append("end_time", body.value.end_time);
    form.append("desc", body.value.desc);

    const res = await $fetch(`${baseApi}/basketballFieldUpdate/${uri.value.userId}?_method=patch`, {
      method: "post",
      body: form,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Update venue error");
  };

  return { uri, body, validation, run };
};

export const deleteVenue = () => {
  const { user } = useAuthStore();
  const uri = ref({ id: null });

  const run = async () => {
    const res = await $fetch(`${baseApi}/deleteBasketBall/${uri.value.id}`, {
      method: "delete",
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Delete venue error");
  };

  return { uri, run };
};

export const getVenue = () => {
  const { user } = useAuthStore();

  const uri = ref({
    userId: null,
  });

  const run = async () => {
    const res = await $fetch(`${baseApi}/basketballFieldDetail/${uri.value.userId}`, {
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Detail venue error");
  };

  return { uri, run };
};
