<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="flex flex-row">
      <div class="w-1/2">
        <NewList/>
      </div>
      <div class="w-1/2">
        <List :lists="lists"/>
      </div>
    </div>
  </AppLayout>
</template>

<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import List from "../Components/Dashboard/Lists.vue";
import NewList from "@/Components/Dashboard/NewList.vue";

interface Props {
  lists: [{
    list_name: string,
    name: string,
    email: string,
  }]
}

const props = defineProps<Props>()

</script>
