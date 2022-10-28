<template>
  <AppLayout title="Dashboard">
    <div class="md:flex md:flex-row">
      <div class="w-3/4 mx-auto border-1 border-gray-200 rounded-lg">
        <div class="text-center mt-4" v-if="lists.length === 0">
          <h5><strong>You do not have any mystery lists!</strong>
          <div><small>*Create a new on the right</small></div></h5>
        </div>
        <List :lists="lists"/>
      </div>
      <div class="w-3/4 mx-auto border-l-2 border-gray-200">
        <NewList/>
      </div>
    </div>
  </AppLayout>
</template>

<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import List from "../Components/Dashboard/Lists.vue";
import NewList from "@/Components/Dashboard/NewList.vue";

interface Props {
  lists: [{
    list_name: string,
    name: string,
    email: string,
  }]
}

const props = defineProps<Props>()

</script>
