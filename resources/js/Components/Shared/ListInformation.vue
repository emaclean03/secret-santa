<template>
  <q-card class="m-2">
    <q-card-section>
      <div class="text-h6">This secret list</div>
    </q-card-section>
    <q-separator/>
    <q-card-section>
      List name: {{ list.list_name }}
    </q-card-section>
  </q-card>
</template>

<script lang="ts" setup>
interface Props {
  list:{
    list_name: string,
  }
}

defineProps<Props>()
</script>
