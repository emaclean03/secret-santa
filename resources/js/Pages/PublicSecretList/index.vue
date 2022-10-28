<template>
    <div class="flex w-full h-screen text-center bg-gradient-to-r from-cyan-400 to-blue-300 ">
      <div class="w-3/4 mx-auto">
        <q-card class="h-max m-2 mt-4 w-3/4 mx-auto">
          <q-separator/>
          <font-awesome-icon icon="fa-solid fa-info-circle" /><div class="text-center inline ml-1 font-bold">Please add your email if it has not yet been added by clicking on the email row of your name.</div>
          <div>
            <small>If you would like to create a wish-list, please register <a href="/register" class="underline text-blue-600 hover:text-blue-800">Here!</a> *Coming soon</small>
          </div>
          <q-separator/>
          <q-card-section class="w-3/4 mx-auto">
            <PublicParticipantList :list="list" :participants="participants"/>
          </q-card-section>
        </q-card>
      </div>
    </div>
</template>

<script lang="ts" setup>
  import PublicParticipantList from "@/Components/Shared/PublicParticipantList.vue";

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
