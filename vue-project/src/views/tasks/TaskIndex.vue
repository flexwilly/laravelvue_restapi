<script setup>
//import the statuses from composables statuses
import useTasks from '../../composables/tasks'

import { onMounted } from 'vue'

//what we need
const { tasks, getTasks, destroyTasks } = useTasks()
onMounted(() => getTasks())
</script>
<template>
  <div class="my-10 p-2">
    <h1 class="text-center">All Tasks</h1>
    <div class="m-2 p-2">
      <RouterLink :to="{ name: 'TaskCreate' }" class="btn btn-primary text-white"
        >New Task</RouterLink
      >
    </div>
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Due Date</th>
          <th scope="col">Status ID</th>
          <th scope="col">Created At</th>
          <th scope="col">Updated At</th>
          <th colspan="2" scope="col">Update / Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tsk in tasks" :key="tsk.id">
          <td>{{ tsk.id }}</td>
          <td>{{ tsk.name }}</td>
          <td>{{ tsk.description }}</td>
          <td>{{ tsk.due_date }}</td>
          <td>{{ tsk.status_id }}</td>
          <td>{{ tsk.created_at }}</td>
          <td>{{ tsk.updated_at }}</td>
          <td colspan="2">
            <RouterLink
              :to="{ name: 'TaskEdit', params: { id: tsk.id } }"
              class="btn btn-warning m-1"
              >Edit</RouterLink
            >
            <button class="btn btn-danger m-1" @click="destroyTask(tsk.id)">Delete</button>
          </td>
          >
        </tr>
      </tbody>
    </table>
  </div>
</template>
