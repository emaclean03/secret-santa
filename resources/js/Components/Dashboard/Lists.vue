<template>
  <div class="h-full mt-12 w-5/6 lg:w-1/2 mx-auto overflow-y-auto overscroll-contain">
    <div v-for="list in lists">
      <q-card class="m-2 w-full lg:w-full mx-auto">
        <q-card-section>
          <div class="text-h5 text-center">{{ list.list_name }}</div>
          <div class="text-xsm text-center">Event Date: {{ list.event_date }}</div>
        </q-card-section>
        <q-separator class="bg-black "/>

        <q-card-section>
          <p><small>Budget: </small>${{ list.list_budget }}</p>
        </q-card-section>

        <q-card-section v-if="list.has_been_drawn">
          <small>The draw has already taken place</small>
        </q-card-section>
        <q-separator class="bg-gray-200 "/>
        <q-card-actions class="w-full">
          <div class="">
          <q-btn color="blue-grey-9" @click="handleViewList(list.id)">View</q-btn>
          </div>
          <div class="ml-2">
            <q-btn color="red-5" class="text-red-900" @click="handleDeleteList(list.id)">Delete</q-btn>
          </div>
        </q-card-actions>
      </q-card>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { router } from '@inertiajs/vue3'

interface Props {
  lists: [{
    id: number,
    list_name: string,
    name: string,
    email: string,
    event_date: string,
    list_budget: number,
    has_been_drawn: boolean,
  }]
}

const props = defineProps<Props>();

const handleDeleteList = (listId: number) => {
  if (!confirm('Are you sure you wish to delete this list?')) {
    return false;
  }
  router.post(`/secretList/${listId}/delete`);
}

const handleViewList = (listId: number) => {
  router.visit(`/secretList/${listId}/show`, {},);
}
</script>

