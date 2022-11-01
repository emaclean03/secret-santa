<template>
  <div class="w-auto lg:w-1/2 mx-auto">
    <div class="flex flex-row">
      <div class="w-full text-center">
        <q-card class="m-2">
          <q-card-section>
            <div class="text-h6">Create New Mystery List</div>
          </q-card-section>
          <q-separator class="bg-black "/>
          <q-card-section>
            <q-form
                ref="myForm"
                @submit.prevent="onSubmit"
                class="q-gutter-md"
            >
              <q-input
                  filled
                  v-model="secretListName"
                  label="Name of list *"
                  clearable
                  :rules="[ val => val && val.length > 0 || 'Please type something']"
              />
              <q-input
                  filled
                  clearable
                  v-model.number="secretListBudget"
                  label="$ Budget"
                  type="number"
                  :rules="[ val => val && val > 0 || 'Please add a budget amount']"
              />

              <q-input
                  filled
                  v-model="secretListEventDate"
                  label="Event date"
                  lazy-rules
                  clearable
                  type="date"
                  :rules="[ val => val && val.length > 0 || 'Please type something']"
              />
              <q-separator class="bg-black "/>
              <q-input
                  v-for="(participant, index) in participantNames"
                  :key="participant.id"
                  filled
                  v-model="participant.name"
                  label="Participant Name *"
                  hint="First and Last Name"
                  class="mt-8"
                  :rules="[ val => val && val.length > 0 || 'Please type something']"
              >
                <template #append>
                  <q-btn v-if="participantNames.length > 3" @click="deleteParticipant(index)" color="blue-grey-9" size="xs">
                    <font-awesome-icon icon="fa-solid fa-x  "/>
                  </q-btn>
                </template>
              </q-input>

              <div>
                <q-btn label="Add participant" @click="addNewUser" class="mr-2 " color="blue-grey-8"/>
                <br>
              </div>
              <q-separator class="bg-black "/>
              <q-card-actions>
                <q-btn label="Submit" size="md" type="submit" class="mx-auto" color="blue-grey-9"/>
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

interface Props{
  user: [
      name: string,
      email: string,
  ],
}

const emit = defineEmits(['created']);

const props = defineProps<Props>();
const myForm = ref(null)
const participantNames = ref([
  { name: props.user['name']},//This is the creator's name (logged in user)
  { name: ''},
  { name: ''}
]);
const secretListName = ref(null);
const secretListBudget = ref(null);
const secretListEventDate = ref(null);

const addNewUser = () => {
  participantNames.value.push({ name: ''});
}


const onSubmit = (event) => {
  Inertia.post('/secretList/store', {
    participantNames: participantNames.value,
    listName: secretListName.value,
    listBudget: secretListBudget.value,
    eventDate: secretListEventDate.value
  }, {
    onSuccess: (page) => {
      secretListName.value = null;
      secretListEventDate.value = null;
      secretListBudget.value = null;
      //Close up the form after successfully created new list
      emit('created');
      participantNames.value = [
        { name: props.user['name']},
        { name: null},
        { name: null}
      ];

      myForm.value.reset();
    },

  })
}

const deleteParticipant = (participant) => {
  participantNames.value.splice(participant, 1) // remove it from array
}

</script>

