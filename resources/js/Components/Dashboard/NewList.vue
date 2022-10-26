<template>
  <div class="w-auto lg:w-1/2 mx-auto">
    <div class="flex flex-row">
      <div class="w-full text-center">
        <q-card class="m-2">
          <q-card-section>
            <div class="text-h6">Create new secret list</div>
          </q-card-section>
          <q-card-section>
            <q-input
                filled
                v-model="secretListName"
                label="Name of list *"
                lazy-rules
                :rules="[ val => val && val.length > 0 || 'Please type something']"
            />
            <q-input
                filled
                v-model.number="secretListBudget"
                label="$ Budget"
                lazy-rules
                type="number"
                :rules="[ val => val && val.length > 0 || 'Please type something']"
            />

            <q-input
                filled
                v-model="secretListEventDate"
                label="Event date"
                lazy-rules
                type="date"
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
                <q-btn label="Add participant" @click="addNewUser" class="mr-2" color="primary"/>
                <br>
              </div>
              <q-separator class="bg-black "/>
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
const secretListBudget = ref(0);
const secretListEventDate = ref(null);

const addNewUser = () => {
  participantNames.value.push({name: ''});
}

const onSubmit = () => {
  Inertia.post('/secretList/store', {participantNames: participantNames.value, listName: secretListName.value, listBudget: secretListBudget.value, eventDate:secretListEventDate.value}, {
    onSuccess: (page) => {
      secretListName.value = '';
      participantNames.value = [ {name: ''},
        {name: ''},
        {name: ''}];
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

