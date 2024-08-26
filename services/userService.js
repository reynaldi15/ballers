import { number, object, string } from "yup";

const {
  public: { baseApi },
} = useRuntimeConfig();

export const getUsers = () => {
  const { user } = useAuthStore();

  const run = async () => {
    const res = await $fetch(`${baseApi}/adminDashboard`, {
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("List User error");
  };

  return { run };
};

export const getUser = () => {
  const { user } = useAuthStore();
  const uri = ref({
    userId: null,
  })

  const run = async () => {
    const res = await $fetch(`${baseApi}/detailUser/${uri.value.userId}`, {
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Detail User error");
  };

  return { uri, run };
};

export const getProfile = () => {
  const { user } = useAuthStore();

  const run = async () => {
    const res = await $fetch(`${baseApi}/profile`, {
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Profile error");
  };

  return { run };
};

export const patchProfile = () => {
  const { user } = useAuthStore();
  const uri = ref({
    userId: null,
  });

  const body = ref({
    role_id: user.role.id,
    name: user.name,
    address: user.address,
    phoneNumber: user.phoneNumber,
    email: user.email,
  });

  const validation = object({
    role_id: number().required(),
    name: string().required("Nama wajib Diisi"),
    address: string().required("Alamat wajib Diisi"),
    phoneNumber: number().required("Nomor Telepon wajib Diisi"),
    email: string().required("Email wajib Diisi"),
  });

  const run = async () => {
    const res = await $fetch(`${baseApi}/updateUser/${uri.value.userId}`, {
      method: "patch",
      body: body.value,
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Update Profile error");
  };

  return { uri, body, validation, run };
};

export const deleteUser = () => {
  const { user } = useAuthStore();
  const uri = ref({
    userId: null,
  })

  const run = async () => {
    const res = await $fetch(`${baseApi}/deleteUser/${uri.value.userId}`, {
      method: 'delete',
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Detail User error");
  };

  return { uri, run };
};