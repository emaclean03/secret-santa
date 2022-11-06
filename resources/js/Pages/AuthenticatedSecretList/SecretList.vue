<template>
  <AppLayout class="w-full">
    <div class="flex flex-row mx-a lg:mt-4">
      <div class="mx-auto lg:w-3/4 w-full text-center">
        <q-card>
          <q-card-section>
            <div v-if="!list.has_been_drawn">
              <h6 v-if="readyToDraw === participants.length"
                  class="block text-green-700 mb-2 border-b border-gray-200 font-bold">
                {{ list.list_name }} list is ready for it's drawing!</h6>
              <p v-else class="block text-green-700 mb-2 border-b border-gray-200 font-bold">Not all participants have
                added their email!</p>
            </div>

            <q-dialog class="w-full" v-model="showDialog">
              <q-card style="width: 700px; max-width: 80vw;">
                <q-card-section>
                  <div class="text-h6">Setting exclusions</div>
                </q-card-section>
                <q-card-section class="q-pt-none">
                  <q-select
                      option-label="full_name"
                      option-value="id"
                      filled
                      v-model="selectedParticipant"
                      :options="participants"
                      label="Select a participant"/>

                  <q-select
                      class="mt-4"
                      v-if="selectedParticipant"
                      option-label="full_name"
                      option-value="id"
                      filled
                      v-model="excludeParticipant"
                      :options="participants.filter((item)=>item.id !== selectedParticipant.id)"
                      label="Cannot draw (Participant to exclude)"/>
                </q-card-section>
                <q-card-actions align="right">
                  <q-btn flat @click="handleExcludeParticipants" label="OK" color="primary" v-close-popup/>
                </q-card-actions>
              </q-card>
            </q-dialog>

            <ListInformation :list="list"/>
            <div class="flex flex-row justify-center">
              <div class="m-2" v-if="!list.has_been_drawn">
                <q-btn color="blue-grey-9" @click="handleStartDraw(list.id)">Start the draw</q-btn>
              </div>
              <div class="m-2" v-else>
                <q-btn color="primary" @click="handleShowDrawnNames">{{ showDrawnNameButton }}</q-btn>
              </div>
              <div :class="{disabled:participants.length <= 3}" class="m-2">
                <q-btn class="mb-3 lg:mb-0" @click="() => showDialog = !showDialog" color="blue-grey-9">
                  <q-tooltip v-if="participants.length <= 3">
                    You must have 4+ participants to use exclusions
                  </q-tooltip>
                  Set Exclusions
                </q-btn>
              </div>
              <div class="m-2">
                <q-btn color="red-5" @click="deleteList(list.id)">Delete this list</q-btn>
              </div>
            </div>
          </q-card-section>
          <q-card-section>
            <div class="text-h6">Share this URL
              <q-btn dense size="md" class="inline mb-1" flat @click="copyToClipBoard((e)=>e.target.value)">
                <font-awesome-icon icon="fa-solid fa-copy"/>
                <q-popup-proxy>
                  <q-banner v-show="copiedToClipboard">
                    Copied!
                  </q-banner>
                </q-popup-proxy>
              </q-btn>

            </div>
            <q-input input-class="text-center" v-model="signedUrl"/>
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
    parent: [{
      full_name: string
    }],
    exclude: [{
      full_name:string
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
  },
  readyToDraw: number,
  errors: {}
}

const props = defineProps<Props>()

const showDrawnNames = ref(false);
const showDrawnNameButton = ref('Show drawn names');
const copiedToClipboard = ref(false);
const showDialog = ref(false);
const selectedParticipant = ref(null);
const excludeParticipant = ref(null);

const copyToClipBoard = () => {
  navigator.clipboard.writeText(props.signedUrl);
  copiedToClipboard.value = true;

  const timeOut = setTimeout(() => {
    copiedToClipboard.value = false;
  }, 1000);
}

const handleShowDrawnNames = () => {
  if (showDrawnNameButton.value === 'Show drawn names') {
    if (!confirm('Are you sure you want to view the drawn names?')) {
      return false;
    } else {
      showDrawnNames.value = !showDrawnNames.value;
      showDrawnNameButton.value = 'Hide drawn names';
    }
  } else {
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

const handleExcludeParticipants = () => {
  Inertia.post(`/participants/${selectedParticipant.value.id}/updateExcludeParticipant`,
      {excluded_participant: excludeParticipant.value.id},
      {
        onSuccess: () => {
          selectedParticipant.value = null;
          excludeParticipant.value = null;
        }
      })
}


import AppLayout from "@/Layouts/AppLayout.vue";
import ListInformation from "@/Components/Shared/ListInformation.vue";
import {Inertia} from "@inertiajs/inertia";
import DrawnNames from "@/Components/Dashboard/DrawnNames.vue";
import {ref} from "vue";
</script>
