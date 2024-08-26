<template>
  <nav
    class="w-full py-2 px-20 fixed z-50 bg-gray-200 border-b-2 border-gray-400"
  >
    <div class="container-wrapper mx-auto flex items-center justify-between">
      <NuxtLink :to="logoLink">
        <img src="~/assets/logo.svg" class="sm:w-16 w-12 sm:h-16" />
      </NuxtLink>
      <div class="flex items-center gap-6">
        <template v-for="menu in navigationMenu" :key="menu.label">
          <BaseLayoutNavbarItem v-if="menu.validation()" v-bind="menu" />
        </template>
        <div class="border-l border-gray-400 pl-6">
          <UDropdown :items>
            <div class="cursor-pointer font-bold flex items-center gap-2">
              {{ user.name }}
              {{ user.role_id }}
              <UIcon name="i-heroicons-chevron-down" />
            </div>
          </UDropdown>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { useMutation } from "@tanstack/vue-query";
import { postLogout } from "~/services/authService";

const router = useRouter();
const toast = useToast();
const { clearUser, user, isBuyer, isAdmin, isSeller } = useAuthStore();

const { run } = postLogout();
const { mutate, isPending } = useMutation({
  mutationFn: run,
  onSuccess: (data) => {
    clearUser();
    console.log(user);

    toast.add({
      title: "Anda telah logout",
    });

    router.push("/");
  },
});

const items = [
  [
    {
      label: "account",
      disabled: isPending.value,
      click: () => router.push("/dashboard/account"),
    },
    {
      label: "Log out",
      disabled: isPending.value,
      click: mutate,
    },
  ],
];

const navigationMenu = ref([
  {
    label: "History Order",
    link: "/dashboard/history",
    validation: () => (isBuyer() || isSeller()),
  },
  {
    label: "Venue",
    link: "/dashboard/venue",
    validation: isSeller,
  },
  {
    label: "Community",
    link: "/dashboard/community",
    validation: isBuyer,
  },
  {
    label: "User",
    link: "/dashboard/user",
    validation: isAdmin,
  },
]);

const logoLink = computed(() => {
  if (isBuyer()) return "/dashboard";
  else if (isSeller()) return "/dashboard/venue";
  else if (isAdmin()) return "/dashboard/user";
});
</script>
