import { mixed, number, object, string } from "yup";

const {
  public: { baseApi },
} = useRuntimeConfig();

export const getCommunities = () => {
  const { user } = useAuthStore();
  const params = ref({
    page: 1,
    size: 12,
  });

  const run = async () => {
    const res = await $fetch(`${baseApi}/community`, {
      params: params.value,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("List community error");
  };

  return { params, run };
};

export const postCommunity = () => {
    const { user } = useAuthStore();
    const body = ref({
    name: null,
    image: null,
    address: null,
    desc: null,
    phone: null,
  });

  const validation = object({
    name: string().required("Nama wajib Diisi"),
    address: string().required("Alamat Diisi"),
    desc: string().required("Deskripsi Diisi"),
    phone: number().required("Nomor Telepon Diisi"),
  });

  const run = async () => {
    const form = new FormData();
    form.append("name", body.value.name);
    form.append("image", body.value.image);
    form.append("address", body.value.address);
    form.append("desc", body.value.desc);
    form.append("phone", body.value.phone);

    const res = await $fetch(`${baseApi}/communityPost`, {
      method: "post",
      body: form,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Create community error");
  };

  return { body, validation, run };
};
