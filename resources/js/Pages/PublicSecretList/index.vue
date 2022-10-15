<template>
  <AppLayout class="w-full">
    <div class="flex flex-row">

    </div>
    <div class="flex flex-row mt-12">
      <div class="w-full">
        <q-card class="m-2 w-1/2">
          <q-card-section>
            <div class="text-h6">Participants</div>
          </q-card-section>
          <q-separator/>
          <q-card-section class="">
            <ParticipantList :list="list" :participants="participants"/>
          </q-card-section>
        </q-card>
      </div>
      <div class="sm:w-full lg:w-1/2">

      </div>
    </div>
  </AppLayout>
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
