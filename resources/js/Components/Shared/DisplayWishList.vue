<template>
<div v-for="item in participant.wish_list_items">
  <q-card
      class="text-white mt-2 w-1/2 mx-auto h-24"
  >
    <q-card-section>
      <div class="text-h6 text-black">{{ item.Description }}</div>
      <q-btn color="blue-grey-9" @click="navigateItemExternal(item.item_url)" size="md" class="text-h6">Link to item</q-btn>
    </q-card-section>
    <q-card-section class="q-pt-none">
    </q-card-section>
  </q-card>
</div>
  <div class="mt-4">
    <AddWishListItem/>
  </div>
</template>

<script lang="ts" setup>
import AddWishListItem from "@/Components/Shared/AddWishListItem.vue";

interface Props{
  participant:[{
    wish_list_items:[{
      id: number,
    }]
  }]
}

const props = defineProps<Props>();

const navigateItemExternal = (item_url) => {
  window.location.href = item_url
}
</script>
