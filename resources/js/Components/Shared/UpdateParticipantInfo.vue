<template>
  <div class="lg:w-2/4 mx-auto" >
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
        <q-btn label="Submit" type="submit" color="primary"/>
      </div>
    </q-form>

  </div>
</template>

<script lang="ts" setup>
import {Inertia} from "@inertiajs/inertia";

interface Props{
  participant:{
    full_name: string,
    id: number,
    email: string,
  }
}

const props = defineProps<Props>()

const handleSaveInfo = (value) => {
  Inertia.post(`/participants/${props.participant.id}/update`, {field:'public_update', full_name: props.participant.full_name, email:props.participant.email})
}

</script>
