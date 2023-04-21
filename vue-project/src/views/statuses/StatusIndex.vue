<script setup>
//import the statuses from composables statuses
import useStatuses from '../../composables/statuses'
import { onMounted } from 'vue'

//what we need
const { statuses, getStatuses, destroyStatus } = useStatuses()
onMounted(() => getStatuses())
</script>
<template>
   <h1 class="text-center">All Statuses</h1>
  <div class="my-10 p-2">
    <div class="m-2 p-2">
      <RouterLink :to="{ name: 'StatusCreate' }" class="btn btn-primary text-white"
        >New Status</RouterLink
      >
    </div>
    
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Created At</th>
          <th scope="col">Updated At</th>
          <th scope="col">Deleted At</th>
          <th colspan="2" scope="col">Update / Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="stats in statuses" :key="stats.id">
          <td>{{ stats.id }}</td>
          <td>{{ stats.name }}</td>
          <td>{{ stats.created_at }}</td>
          <td>{{ stats.updated_at }}</td>
          <td>{{ stats.deleted_at }}</td>
          <td colspan="2">
            <RouterLink
              :to="{ name: 'StatusEdit', params: { id: stats.id } }"
              class="btn btn-warning m-1"
              >Edit</RouterLink
            >
            <button class="btn btn-danger m-1" @click="destroyStatus(stats.id)">Delete</button>
          </td>
          >
        </tr>
      </tbody>
    </table>
  </div>
</template>
