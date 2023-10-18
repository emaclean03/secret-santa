<template>
  <q-card class="m-2">
    <q-card-section>
      <div class="text-h6 text-center"><p class="-mb-1 underline font-bold">Participants</p>
        <font-awesome-icon class="w-3" icon="fa-solid fa-info-circle"/>
        <small>You may update any participant Name or Email in this table by clicking on the column</small>
      </div>
    </q-card-section>
    <q-separator/>
    <q-table
        class="participants-list"
        :rows="participants"
        :columns="columns"
        row-key="name"
        separator="vertical"
        :filter="filter"
        :virtual-scroll-sticky-size-start="12"
        virtual-scroll
        :rows-per-page-options="[0]"
    >
      <template v-slot:top-right>
        <q-input dense debounce="150" v-model="filter" placeholder="Search name or email">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </template>
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="full_name" :props="props">
            {{props.row.exclude ? props.row.full_name + ' excludes ' + props.row.exclude.full_name : props.row.full_name}}
            <q-popup-edit @save="(val) => handleSaveFullName(val, props.row.id)" title="Update name"
                          v-model="props.row.full_name" buttons v-slot="scope">
              <q-input v-model="scope.value" dense autofocus/>
            </q-popup-edit>
          </q-td>
          <q-td key="email" :props="props">
            {{ props.row.email }}
            <q-popup-edit v-model="props.row.email"  @save="(val) => handleSaveEmail(val, props.row.id)"
                          title="Update email" buttons v-slot="scope">
              <q-input v-model="scope.value" :rules="[ (val, rules) => rules.email(val) || 'Please enter a valid email address' ]" dense autofocus/>
            </q-popup-edit>
          </q-td>
          <q-td key="Actions" :props="props">
            <q-btn v-if="participants.length > 3" @click="handleDeleteParticipant(props.row)" color="blue-grey-9" size="xs">
              <font-awesome-icon icon="fa-solid fa-x  "/>
            </q-btn>

          </q-td>
        </q-tr>
      </template>
      <template v-if="!list.has_been_drawn" #top-left>
            <q-btn class="mb-3 lg:mb-0" @click="handleAddParticipant" color="blue-grey-9">Add participant</q-btn>
      </template>
    </q-table>
  </q-card>

</template>

<script lang="ts" setup>
import { router } from '@inertiajs/vue3'
import {ref} from "vue";

interface Props {
  participants: [{
    email: string,
    full_name: string,
    exclude:[{
      full_name:string,
    }]
  }],
  list: {
    id: number,
    email: string,
    list_name: string,
    name: string,
    has_been_drawn: boolean,
  }
}

const props = defineProps<Props>()
const filter = ref('');
const columns = [
  {
    name: 'full_name',
    required: true,
    label: 'Name',
    align: 'left',
    field: row => row.full_name,
    sortable: true
  },
  {name: 'email', align: 'center', label: 'Email', field: 'email', sortable: true},
  {name: 'Actions', align: 'right', label: 'Actions'},
]

const handleSaveFullName = (value, participantId) => {
  router.post(`/participants/${participantId}/updateFullName`, { fullName: value})
}

const handleSaveEmail = (value, participantId) => {
  router.post(`/participants/${participantId}/updateEmail`, { email: value})
}

const handleDeleteParticipant = (participant) => {
  router.post(`/secretList/${props.list.id}/update`, {participantId: participant.id}, {
    onBefore: () => confirm('Are you sure you wish to delete this participant?')
  })
}

const handleAddParticipant = () => {
  const full_name = prompt('What is the participant name?');
  if(full_name) {
    router.post(`/participants/${props.list.id}/store`, {full_name})
  }
}
</script>

<style lang="sass">
.participants-list
  /* height or max-height is important */
  height: 310px

  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th
    /* bg color is important for th; just specify one */
    background-color: white

  thead tr th
    position: sticky
    z-index: 1
  thead tr:first-child th
    top: 0

  /* this is when the loading indicator appears */
  &.q-table--loading thead tr:last-child th
    /* height of all previous header rows */
    top: 48px
</style>