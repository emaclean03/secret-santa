<template>
  <div class="q-pa-md" style="max-width: 400px">
    <q-form
        @submit="onSubmit"
        @reset="onReset"
        class="q-gutter-md"
    >
      <q-input
          v-for="participant in participantNames"
          filled
          v-model="participant.name"
          label="Participant Name *"
          hint="First and Last Name"
          lazy-rules
          :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      <div>
        <q-btn label="Add more" @click="addNewUser" class="mr-2" color="primary"/>
        <br>
        <br>
        <q-btn label="Submit" type="submit" color="primary"/>
        <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" />
      </div>
    </q-form>
  </div>
</template>

<script lang="ts" setup>
  import {ref} from "vue";
  import {Inertia} from "@inertiajs/inertia";

  const ownerName = ref<string>(null);
  const participantNames = ref([{name:''}]);


  const addNewUser = () => {
    participantNames.value.push({name:''});
  }

  const onSubmit = () => {
    Inertia.post('/secretList/store', {participantNames: participantNames.value})
  }
  const onReset = () =>{
    ownerName.value = null;
    participantNames.value = [];
    participantNames.value.push({name:''});
  }

</script>

