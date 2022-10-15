<template>
  <div class="q-pa-md" style="max-width: 400px">
    <div class="flex flex-row">
      <div class="w-full text-center">
        <q-card class="m-2">
          <q-card-section>
            <div class="text-h6">Create a new list</div>
          </q-card-section>
          <q-card-section>
            <q-input
                filled
                v-model="secretListName"
                label="Name of this list"
                lazy-rules
                :rules="[ val => val && val.length > 0 || 'Please type something']"
            />
          </q-card-section>
          <q-separator class="bg-black "/>
          <q-card-section>
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
                  class="mt-8"
                  lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Please type something']"
              />
              <div>
                <q-btn label="Add more" @click="addNewUser" class="mr-2" color="primary"/>
                <br>
              </div>
              <q-card-actions>
                <q-btn label="Submit" type="submit" color="primary"/>
                <q-btn label="Reset" type="reset" color="negative" class="q-ml-sm"/>
              </q-card-actions>
            </q-form>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

const participantNames = ref([
  {name: ''},
  {name: ''},
  {name: ''}
]);
const secretListName = ref(null);

const addNewUser = () => {
  for (let i = 0; i < 3; i++) {
    participantNames.value.push({name: ''});
  }
}

const onSubmit = () => {
  Inertia.post('/secretList/store', {participantNames: participantNames.value, listName: secretListName.value}, {
    onSuccess: (page) => {
      secretListName.value = '';
      participantNames.value = [];
    },

  })
}
const onReset = () => {
  participantNames.value = [];
  secretListName.value = '';
  for (let i = 0; i < 3; i++) {
    participantNames.value.push({name: ''});
  }
}

</script>

