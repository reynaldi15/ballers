export default defineNuxtRouteMiddleware((to, from) => {
  const { push } = useRouter();
  const { isLoggedIn } = useAuthStore();
  return isLoggedIn() || push("/");
});
