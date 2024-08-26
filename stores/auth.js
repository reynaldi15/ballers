export const useAuthStore = defineStore("auth", () => {
  const user = useLocalStorage("user", {
    id: null,
    token: null,
    role: null,
    name: null,
    address: null,
    phoneNumber: null,
    email: null,
    email_verified_at: null,
    expired: null,
    created_at: null,
    updated_at: null,
  });

  const isLoggedIn = () => (!!user.value?.id && new Date(user.value?.expired) > new Date());
  const isAdmin = () => user.value?.role?.id === 1;
  const isBuyer = () => user.value?.role?.id === 2;
  const isSeller = () => user.value?.role?.id === 3;

  const setUser = (payload) => {
    if (payload.data.id) user.value.id = payload.data.id;
    if (payload.token) user.value.token = payload.token;
    if (payload.data.role) user.value.role = payload.data.role;
    if (payload.data.name) user.value.name = payload.data.name;
    if (payload.data.address) user.value.address = payload.data.address;
    if (payload.data.phone) {
      user.value.phone = payload.data.phone;
      user.value.phoneNumber = payload.data.phone;
    }
    if (payload.data.email) user.value.email = payload.data.email;
    if (payload.data.email_verified_at)
      user.value.email_verified_at = payload.data.email_verified_at;
    if (payload.data.created_at)
      user.value.created_at = payload.data.created_at;
    if (payload.data.updated_at)
      user.value.updated_at = payload.data.updated_at;
    if (!user.value.expired) {
      const d = new Date();
      user.value.expired = new Date(
        d.getFullYear(),
        d.getMonth(),
        d.getDate() + 1
      );
    }
  };

  const clearUser = () =>
    (user.value = {
      id: null,
      token: null,
      role: null,
      name: null,
      address: null,
      phoneNumber: null,
      email: null,
      email_verified_at: null,
      expired: null,
      created_at: null,
      updated_at: null,
    });

  return { user, isLoggedIn, isAdmin, isBuyer, isSeller, setUser, clearUser };
});
