<template>
  <AppLayout class="w-full">
    <div class="flex flex-row mx-a lg:mt-4">
      <div class="mx-auto lg:w-3/4 w-full text-center">
        <q-card>
          <q-card-section>
            <ListInformation :list="list"/>
          </q-card-section>
          <q-card-section>
            <div class="text-h6">Share this URL <button class="inline" @click="copyToClipBoard((e)=>e.target.value)"><font-awesome-icon icon="fa-solid fa-copy" /></button></div>
            <q-input v-model="signedUrl"/>
          </q-card-section>
        </q-card>
      </div>
    </div>
    <div class="flex flex-row mt-4">
      <div class="w-full lg:w-3/4 mx-auto">
        <ParticipantList :list="list" :participants="participants"/>
      </div>
      <div v-if="list.has_been_drawn" class="w-full mx-auto lg:w-3/4">
        <DrawnNames :list="list" :showDrawnNames="showDrawnNames" :participants="participants"/>
      </div>
    </div>
    <div class="flex flex-row">
      <div class="lg:w-3/4 w-full mx-auto text-center">
        <q-card class="m-2">
          <q-card-section>
            <div class="text-h6">Actions</div>
          </q-card-section>
          <q-separator/>
          <q-card-actions>
            <q-btn v-if="!list.has_been_drawn" color="primary" @click="handleStartDraw(list.id)">Start the draw</q-btn>
            <q-btn v-else color="primary" @click="handleShowDrawnNames">{{ showDrawnNameButton }}</q-btn>
            <q-btn color="red-5" @click="deleteList(list.id)">Delete this list</q-btn>
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
    drawn_name: string,
    parent:[{
      full_name: string
    }]
  }],
  list: {
    id: number,
    email: string,
    list_name: string,
    event_date: string,
    list_budget: number,
    name: string,
    has_been_drawn: boolean,
  }
}

const props = defineProps<Props>()

const showDrawnNames = ref(false);
const showDrawnNameButton = ref('Show drawn names');

const copyToClipBoard = () => {
  navigator.clipboard.writeText(props.signedUrl);
}

const handleShowDrawnNames = () => {
  if(showDrawnNameButton.value === 'Show drawn names'){
    if(!confirm('Are you sure you want to view the drawn names?')){
      return false;
    }else{
      showDrawnNames.value = !showDrawnNames.value;
      showDrawnNameButton.value = 'Hide drawn names';
    }
  }else{
    showDrawnNames.value = !showDrawnNames.value;
    showDrawnNameButton.value = 'Show drawn names'
  }
}

const handleStartDraw = (listId) => {
  Inertia.post(`/secretList/${listId}/draw`, {}, {
    onSuccess: (page) => {
      console.log(page);
    },
  })
}

const deleteList = (listId) => {
  Inertia.post(`/secretList/${listId}/delete`, {}, {
    onBefore: () => confirm('Are you sure you want to delete this list?'),
  })
}


import AppLayout from "@/Layouts/AppLayout.vue";
import ListInformation from "@/Components/Shared/ListInformation.vue";
import {Inertia} from "@inertiajs/inertia";
import DrawnNames from "@/Components/Dashboard/DrawnNames.vue";
import {ref} from "vue";
</script>
