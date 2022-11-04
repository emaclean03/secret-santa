<template>
  <div class="lg:w-2/4 mx-auto mb-4" >
    <q-form
        @submit="handleSaveInfo"
        class="q-gutter-md"
    >
      <q-input
        filled
          v-model="participant.full_name"
          label="Full Name"
          lazy-rules
          :rules="[ val => val && val.length > 0 || 'Please type something']"
      />

      <q-input
          filled
          type="email"
          v-model="participant.email"
          label="Email"
          lazy-rules
          :rules="[ val => val && val.length > 0 || 'Please add an Email']"
      />
      <div>
        <q-btn label="Submit" type="submit" c color="primary"/>
      </div>
    </q-form>

  </div>
  <q-separator/>
</template>

<script lang="ts" setup>
import {Inertia} from "@inertiajs/inertia";

interface Props{
  participant:{
    id: number,
    full_name: string,
    email: string,
    wish_list_items:[{
      id:number,
      Description: string,
      item_url: string,
      priority: string,
    }]
  },
  errors?: {}
}

const props = defineProps<Props>()
console.log(props.participant.wish_list_items);
const handleSaveInfo = (value) => {
  Inertia.post(`/participants/${props.participant.id}/updatePublic`, {fullName: props.participant.full_name, email:props.participant.email})
}

const handleCreateWishlist = (participantId) => {
  //create wishlist
  //navigate to list
}

</script>
