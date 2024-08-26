import { number, object, string, ref as yupRef } from "yup";

const {
  public: { baseApi },
} = useRuntimeConfig();

export const postLogin = () => {
  const body = ref({
    email: null,
    password: null,
    remember_me: false,
  });

  const validation = object({
    email: string().required("Email wajib Diisi").email("email tidak valid"),
    password: string().required("Password wajib Diisi"),
  });

  const run = async () => {
    const res = await $fetch(`${baseApi}/login`, {
      method: "post",
      body: body.value,
    });

    if (res) return res;
    throw new Error("Login error");
  };

  return { body, validation, run };
};






export const postLogout = () => {
  const { user } = useAuthStore();

  const run = async () => {
    const res = await $fetch(`${baseApi}/logout`, {
      method: "post",
      headers: {
        Authorization: `Bearer ${user.token}`,
      },
    });

    if (res) return res;
    throw new Error("Logout error");
  };

  return { run };
};

export const postRegister = () => {
  const body = ref({
    role_id: null,
    name: null,
    address: null,
    phoneNumber: null,
    email: null,
    password: null,
    confirm_password: null,
  });

  const validation = object({
    role_id: number().required("Role wajib Diisi"),
    name: string().required("Nama wajib Diisi"),
    address: string().required("Alamat wajib Diisi"),
    phoneNumber: number().required("Nomor Telepon wajib Diisi"),
    email: string().required("Email wajib Diisi").email("email tidak valid"),
    password: string().required("Password wajib Diisi"),
    confirm_password: string()
      .required("Konfirmasi Password wajib Diisi")
      .oneOf([yupRef("password")], "Password tidak sama"),
  });

  const run = async () => {
    const res = await $fetch(`${baseApi}/register`, {
      method: "post",
      body: body.value,
    });

    if (res) return res;
    throw new Error("Register error");
  };

  return { body, validation, run };
};
