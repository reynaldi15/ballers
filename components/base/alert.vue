<template>
  <UModal v-model="model">
    <div class="p-4 text-center space-y-6">
      <UIcon name="i-heroicons-exclamation-circle" class="text-[13rem]" />
      <div class="font-bold text-lg">
        Apakah anda yakin untuk menghapus data ini?
      </div>
      <div class="flex gap-3 items-center justify-between">
        <UButton size="lg" class="flex-grow" color="white" @click="model = false"><div class="text-center w-full">Tidak</div></UButton>
        <UButton size="lg" class="flex-grow" color="green" @click="submit"><div class="text-center w-full">Ya</div></UButton>
      </div>
    </div>
  </UModal>
</template>

<script setup>
const emit = defineEmits(["submit"]);
const model = defineModel();

const submit = () => {
  emit('submit');
  model.value = false;
}
</script>
