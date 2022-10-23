<template>
  <div v-for="list in lists">
    <q-card class="m-2 lg:w-1/2 mx-auto">
      <q-card-section>
        <div class="text-h5 text-center">{{ list.list_name }}</div>
        <div class="text-xsm text-center">Draw Date: {{ list.event_date }}</div>
      </q-card-section>
      <q-separator class="bg-black "/>

      <q-card-section>
        <p><small>Budget: </small>${{ list.list_budget }}</p>
      </q-card-section>

      <q-card-section v-if="list.has_been_drawn">
        <small>The draw has already taken place</small>
      </q-card-section>
      <q-separator class="bg-gray-200 "/>
      <q-card-actions>
        <q-btn color="primary" @click="handleViewList(list.id)">View</q-btn>
        <q-btn color="red" @click="handleDeleteList(list.id)">Delete</q-btn>
      </q-card-actions>
    </q-card>
  </div>
</template>

<script lang="ts" setup>
import {Inertia} from "@inertiajs/inertia";

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
  Inertia.post(`/secretList/${listId}/delete`);
}

const handleViewList = (listId: number) => {
  Inertia.visit(`/generateList/${listId}`, {},);
}
</script>

