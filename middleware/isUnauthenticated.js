export default defineNuxtRouteMiddleware((to, from) => {
  const { push } = useRouter();
  const authStore = useAuthStore();

  if (!authStore.isLoggedIn()) return true;

  if (authStore.isAdmin()) {
    push("/dashboard/user");
  }

  if (authStore.isSeller()) {
    push("/dashboard/venue");
  }

  if (authStore.isBuyer()) {
    push("/dashboard");
  }
});
