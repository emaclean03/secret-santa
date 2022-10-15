<template>
  <AppLayout class="w-full">
    <div class="flex flex-row ">
      <div class="w-full text-center">
        <q-card>
          <q-card-section>
            <div class="text-h6">Share this URL</div>
          </q-card-section>
          <q-separator/>
          <q-card-section>
            <q-input v-model="signedUrl"/>
          </q-card-section>
        </q-card>
      </div>
    </div>
    <div class="flex flex-row mt-12">
      <div class="w-full lg:w-1/2">
        <ParticipantList :list="list" :participants="participants"/>
      </div>
      <div class="w-full lg:w-1/2">
        <ListInformation :list="list"/>
      </div>
    </div>
    <div class="flex flex-row">
      <div class="w-full text-center">
        <q-card class="m-2">
          <q-card-section>
            <div class="text-h6">Actions</div>
          </q-card-section>
          <q-separator/>
          <q-card-actions>
                  <q-btn color="primary" @click="handleAddParticipant(list.id)">Start the draw</q-btn>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </AppLayout>
</template>

<script lang="ts" setup>
import ParticipantList from "@/Components/Shared/ParticipantList.vue";

interface Props {
  signedUrl: string,
  participants: [{
    email: string,
    full_name: string,
  }],
  list: {
    id: number,
    email: string,
    list_name: string,
    name: string,
  }
}
const props = defineProps<Props>()
const handleAddParticipant = (listId) => {
  //Add new participant text box
  console.log('adding');
}


import AppLayout from "@/Layouts/AppLayout.vue";
import ListInformation from "@/Components/Shared/ListInformation.vue";
import {Inertia} from "@inertiajs/inertia";
</script>
