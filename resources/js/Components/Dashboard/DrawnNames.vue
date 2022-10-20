<template>
  <q-card class="m-2" v-show="showDrawnNames">
    <q-card-section>
      <div class="text-h6">Who has who</div>
    </q-card-section>
    <q-separator/>
    <q-table
        :rows="participants"
        :columns="columns"
        row-key="full_name"
    >
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="full_name" :props="props">
            {{ props.row.full_name }}
          </q-td>
          <q-td key="parent.full_name" :props="props">
            {{ props.row.parent.full_name }}
          </q-td>
        </q-tr>
      </template>
    </q-table>
  </q-card>
</template>

<script lang="ts" setup>

interface Props {
  participants: [{
    email: string,
    full_name: string,
    drawn_participant_id: string,
    parent: {
      full_name: string,
    }
  }],
  list: {
    id: number,
    email: string,
    list_name: string,
    name: string,
    has_been_drawn: boolean,
  }
  showDrawnNames:boolean,
}


const columns = [
  {
    name: 'full_name',
    required: true,
    label: 'Name',
    align: 'left',
    sortable: true
  },
  {
    name: 'parent.full_name',
    required: true,
    label: 'Drawn participant',
    align: 'left',
    sortable: true
  },
]

const props = defineProps<Props>()

console.log(props.participants[0].parent)
</script>