// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  ssr: false,
  experimental: {
    appManifest: false,
  },
  modules: [
    "@vueuse/nuxt",
    "@nuxt/ui",
    "nuxt-typed-router",
    "dayjs-nuxt",
    "@pinia/nuxt",
  ],
  dayjs: {
    plugins: ["relativeTime", "timezone"],
    defaultLocale: "id",
    defaultTimezone: "Asia/Jakarta",
  },
  colorMode: {
    preference: "light",
  },
  runtimeConfig: {
    public: {
      baseApi: process.env.API_URL,
      storageApi: process.env.STORAGE_URL,
    },
  },
  ui: {
    safelistColors: ["main"],
  },
  tailwindcss: {
    cssPath: "~/assets/css/tailwind.css",
    config: {
      theme: {
        extend: {
          colors: {
            main: {
              DEFAULT: "#1F2936",
              50: "#6682A7",
              100: "#5B789E",
              200: "#4C6484",
              300: "#3D506A",
              400: "#2E3D50",
              500: "#1F2936",
              600: "#0B0E12",
              700: "#000000",
              800: "#000000",
              900: "#000000",
              950: "#000000",
            },
            secondary: {
              DEFAULT: "#FC4100",
              50: "#FFC8B5",
              100: "#FFB9A0",
              200: "#FF9A77",
              300: "#FF7C4F",
              400: "#FF5E26",
              500: "#FC4100",
              600: "#C43300",
              700: "#8C2400",
              800: "#541600",
              900: "#1C0700",
              950: "#000000",
            },
            tertiary: {
              DEFAULT: "#25BD22",
              50: "#A9EFA7",
              100: "#98EC96",
              200: "#76E673",
              300: "#54E051",
              400: "#32D92E",
              500: "#25BD22",
              600: "#1C8D19",
              700: "#125E11",
              800: "#092E08",
              900: "#000000",
              950: "#000000",
            },
          },
        },
      },
    },
  },
});
