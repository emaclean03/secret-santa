<template>
  <q-card class="">
    <q-card-section>
      <h4><strong>{{ list.list_name }}</strong></h4>
    </q-card-section>
    <q-separator/>
    <q-card-section>
      <p><strong>Event Date:</strong> {{list.event_date}}</p>
      <p><strong>Budget:</strong> ${{list.list_budget}}</p>
    </q-card-section>
  </q-card>
</template>

<script lang="ts" setup>
interface Props {
  list:{
    list_name: string,
    id: number,
    email: string,
    event_date: string,
    list_budget: number,
    name: string,
    has_been_drawn: boolean,
  }
}

defineProps<Props>()
</script>
