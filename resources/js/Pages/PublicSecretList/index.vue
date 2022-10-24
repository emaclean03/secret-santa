<template>
    <div class="flex w-full text-center bg-gray-200">
      <div class="w-full mx-auto">
        <q-card class="m-2 mt-4">
          <q-separator/>
          <font-awesome-icon icon="fa-solid fa-info-circle" /><div class="text-center inline ml-1 font-bold">Please add your email if it has not yet been added by clicking on the email row of your name.</div>
          <div>
            <small>If you would like to create a wish-list, please register <a href="/register" class="underline text-blue-600 hover:text-blue-800">Here!</a> *Coming soon</small>
          </div>
          <q-card-section class="">
            <ParticipantList :list="list" :participants="participants"/>
          </q-card-section>
        </q-card>
      </div>
    </div>
</template>

<script lang="ts" setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ParticipantList from "@/Components/Shared/ParticipantList.vue";

interface Props {
  list: {
    id: number,
    email: string,
    list_name: string,
    name: string,
  },
  participants: [{
    id: number,
    full_name: string,
    email: string,
  }]
}

const props = defineProps<Props>();


</script>
