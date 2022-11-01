<template>
  <Banner/>
  <div class="flex w-full h-screen text-center bg-gradient-to-r from-indigo-200 to-transparent">
    <div class="lg:w-3/4 w-full mx-auto mt-1">
      <ListInformation :list="list"/>
      <q-card class="h-max m-2 w-full mt-4 lg:w-3/4 mx-auto">

        <font-awesome-icon icon="fa-solid fa-info-circle"/>
        <div class="text-center inline ml-1 font-bold">
          Please choose your name in the dropdown. You can then update your email
        </div>

        <q-separator/>
        <q-card-section class="lg:w-1/2 mx-auto bg-">
          <q-select
              option-label="full_name"
              option-value="id"
              filled
              v-model="selectedParticipant"
              :options="participants"
              label="Your name"/>
        </q-card-section>
        <q-separator class="bg-black"/>
        <q-card-section>
          <UpdateParticipantInfo v-if="selectedParticipant" :participant="selectedParticipant"/>
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>

<script lang="ts" setup>
import PublicParticipantList from "@/Components/Shared/PublicParticipantList.vue";
import {ref} from "vue";
import UpdateParticipantInfo from "@/Components/Shared/UpdateParticipantInfo.vue";
import Banner from '@/Components/Banner.vue';
import ListInformation from "@/Components/Shared/ListInformation.vue";

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

const selectedParticipant = ref(null);

</script>
