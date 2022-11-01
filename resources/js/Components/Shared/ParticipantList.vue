<template>
  <q-card class="m-2">
    <q-card-section>
      <div class="text-h6 text-center">Participants<br>
        <font-awesome-icon class="w-3" icon="fa-solid fa-info-circle"/>
        <small>You may update any participant Name or Email in this table.</small>
      </div>
    </q-card-section>
    <q-separator/>
    <q-table
        :rows="participants"
        style="height: 400px"
        :columns="columns"
        row-key="name"
        :filter="filter"
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
            {{ props.row.full_name }}
            <q-popup-edit @save="(val) => handleSaveFullName(val, props.row.id)" title="Update name"
                          v-model="props.row.full_name" buttons v-slot="scope">
              <q-input v-model="scope.value" dense autofocus/>
            </q-popup-edit>
          </q-td>
          <q-td key="email" :props="props">
            {{ props.row.email }}
            <q-popup-edit v-model="props.row.email" @save="(val) => handleSaveEmail(val, props.row.id)"
                          title="Update email" buttons v-slot="scope">
              <q-input v-model="scope.value" dense autofocus/>
            </q-popup-edit>
          </q-td>
          <q-td key="Actions" :props="props">
            <q-btn v-if="participants.length > 3" @click="handleDeleteParticipant(props.row)" color="blue-grey-9" size="xs">
              <font-awesome-icon icon="fa-solid fa-x  "/>
            </q-btn>
          </q-td>
        </q-tr>
      </template>
      <template #bottom>
            <q-btn class="mt-4" @click="handleAddParticipant" color="blue-grey-9">Add participant</q-btn>
      </template>
    </q-table>
  </q-card>
</template>

<script lang="ts" setup>
import {Inertia} from "@inertiajs/inertia";
import {ref} from "vue";

interface Props {
  participants: [{
    email: string,
    full_name: string,
  }],
  list: {
    id: number,
    email: string,
    list_name: string,
    name: string,
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
  Inertia.post(`/participants/${participantId}/update`, {field:'full_name', value: value})
}

const handleSaveEmail = (value, participantId) => {
  Inertia.post(`/participants/${participantId}/update`, {field: 'email', value: value})
}

const handleDeleteParticipant = (participant) => {
  Inertia.post(`/secretList/${props.list.id}/update`, {participantId: participant.id}, {
    onBefore: () => confirm('Are you sure you wish to delete this participant?')
  })
}

const handleAddParticipant = () => {
  const full_name = prompt('What is the participant name?');
  if(full_name) {
    Inertia.post(`/participants/${props.list.id}/store`, {full_name})
  }
}
</script>
