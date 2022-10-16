<template>
  <div v-for="list in lists">
    <q-card class="my-card m-2">
      <q-card-section>
        <div class="text-h6">{{ list.list_name }}</div>
      </q-card-section>
      <q-separator class="bg-black "/>

      <q-card-section>
        {{ list.list_name }}
      </q-card-section>
      <q-card-actions>
        <q-btn color="primary" @click="handleViewList(list.id)">View</q-btn>
        <q-btn color="red" @click="handleDeleteList(list.id)">Leave</q-btn>
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

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 250px
</style>