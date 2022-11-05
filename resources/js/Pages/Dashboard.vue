<template>
  <AppLayout title="Dashboard">
    <div class="lg:flex lg:flex-row">
      <div class="lg:w-3/4 mx-auto border-1 border-gray-200 rounded-lg">
        <div class="text-center mt-4" v-if="lists.length === 0">
          <h5><strong>You do not have any mystery lists!</strong></h5>
        </div>
        <div class="lg:w-3/4 w-full text-center mt-2 mx-auto">
          <q-btn
              color="blue-grey-9"
              class="text-center"
              :icon="expandedNewList ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"
              @click="expandedNewList = !expandedNewList"
              :label="!expandedNewList ? 'Create a new mystery list' : 'Close'"
          />
          <q-slide-transition>
            <div v-show="expandedNewList">
              <q-separator />
              <q-card-section class="text-subtitle2">
                <NewList @created="expandedNewList = !expandedNewList" :user="user"/>
              </q-card-section>
            </div>
          </q-slide-transition>
        </div>
        <List :lists="lists"/>
      </div>
    </div>
  </AppLayout>
</template>

<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import List from "../Components/Dashboard/Lists.vue";
import NewList from "@/Components/Dashboard/NewList.vue";
import {ref} from "vue";

interface Props {
  lists: [{
    list_name: string,
    name: string,
    email: string,
  }],
  user:[
      name: string,
      email: string,
  ]
}

const props = defineProps<Props>()
const expandedNewList = ref(false);


</script>
