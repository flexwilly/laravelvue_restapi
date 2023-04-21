<script setup>
//import the statuses from composables statuses
import useUserTasks from '../../composables/usertasks'
import { onMounted } from 'vue'

//what we need
const { usertasks, getUserTasks, destroyUserTask } = useUserTasks()
onMounted(() => getUserTasks())
</script>
<template>
  <div class="my-10 p-2">
    <h1 class="text-center">All User Tasks</h1>
    <div class="m-2 p-2">
      <RouterLink :to="{ name: 'UserTaskCreate' }" class="btn btn-primary text-white"
        >New User Task</RouterLink
      >
    </div>
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">User ID</th>
          <th scope="col">Task ID</th>
          <th scope="col">Due Date</th>
          <th scope="col">Start time</th>
          <th scope="col">End Time</th>
          <th scope="col">Remarks</th>
          <th scope="col">Status ID</th>
          <th scope="col">Created At</th>
          <th scope="col">Updated At</th>
          <th colspan="2" scope="col">Update / Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usrtsk in usertasks" :key="usrtsk.id">
          <td>{{ usrtsk.id }}</td>
          <td>{{ usrtsk.user_id }}</td>
          <td>{{ usrtsk.task_id }}</td>
          <td>{{ usrtsk.due_date }}</td>
          <td>{{ usrtsk.start_time }}</td>
          <td>{{ usrtsk.end_time }}</td>
          <td>{{ usrtsk.remarks }}</td>
          <td>{{ usrtsk.status_id }}</td>
          <td>{{ usrtsk.created_at }}</td>
          <td>{{ usrtsk.updated_at }}</td>
          <td colspan="2">
            <RouterLink
              :to="{ name: 'UserTaskEdit', params: { id: usrtsk.id } }"
              class="btn btn-warning m-1"
              >Edit</RouterLink
            >
            <button class="btn btn-danger m-1" @click="destroyUserTask(usrtsk.id)">Delete</button>
          </td>
          >
        </tr>
      </tbody>
    </table>
  </div>
</template>
