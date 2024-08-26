
// export const postUpload = () => {
//   const body = ref({
//     image: null,
//   });

//   const validation = object({
//     email: string().required("Email wajib Diisi").email("email tidak valid"),
//   });

//   const run = async () => {
//     const res = await $fetch(`${baseApi}/login`, {
//       method: "post",
//       body: body.value,
//     });

//     if (res) return res;
//     throw new Error("Login error");
//   };

//   return { body, validation, run };
// };