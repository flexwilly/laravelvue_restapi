<script setup>
//imports
import { reactive } from 'vue'
import useStatuses from '../../composables/statuses'
import useTasks from '../../composables/tasks'
import useUserTasks from '../../composables/usertasks'
import { onMounted } from 'vue'

//what we need to retrieve statuses for the select
const { getStatuses, statuses } = useStatuses()

//get the tasks for the select
const { getTasks, tasks } = useTasks()

//to perform the update
//what we need to update tasks
const { usertask, getUserTask, updateUserTask, errors } = useUserTasks()

//get the id in the url
const props = defineProps({
  id: {
    required: true,
    type: String
  }
})

//retrieve status ids
onMounted(() => getStatuses())
//retrieve task ids
onMounted(() => getTasks())

//retrieve usertasks
onMounted(() => getUserTask(props.id))
</script>

<template>
  <div class="m-5">
    <form
      class="border border-dark p-4 col-md-9 m-2"
      @submit.prevent="updateUserTask($route.params.id)"
    >
      <h1 class="text-center">Create User Task</h1>
      <!--enter user_id-->
      <label for="User ID" class="form-label">User ID</label>
      <div class="mb-3">
        <input
          type="number"
          v-model="usertask.user_id"
          class="form-control"
          id="user_id"
          placeholder="Enter User ID"
          min="0"
        />
        <div v-if="errors.user_id">
          <span class="text-sm text-danger">{{ errors.user_id[0] }}</span>
        </div>
      </div>

      <!--select tag for task id-->
      <div class="mb-3">
        <label for="Task ID" class="form-label">Task ID</label>
        <select v-model="usertask.task_id" class="form-select" aria-label="Default select example">
          <option v-for="tsk in tasks" :key="tsk.id">
            {{ tsk.id }}
          </option>
        </select>
        <!---If error occurs-->
        <div v-if="errors.task_id">
          <span class="text-sm text-danger">{{ errors.task_id[0] }}</span>
        </div>
      </div>

      <!--due date-->
      <div class="mb-3">
        <label for="Due Date" class="form-label">Due Date</label>
        <input
          type="datetime-local"
          v-model="usertask.due_date"
          class="form-control"
          id="name"
          placeholder="Enter Date"
        />
        <!---If error occurs-->
        <div v-if="errors.due_date">
          <span class="text-sm text-danger">{{ errors.due_date[0] }}</span>
        </div>
      </div>

      <!--start time-->
      <div class="mb-3">
        <label for="Start time" class="form-label">Start Time</label>
        <input
          type="datetime-local"
          v-model="usertask.start_time"
          class="form-control"
          id="start_time"
          placeholder="Enter Start Time"
        />
        <!---If error occurs-->
        <div v-if="errors.start_time">
          <span class="text-sm text-danger">{{ errors.start_time[0] }}</span>
        </div>
      </div>

      <!--end time-->
      <div class="mb-3">
        <label for="End time" class="form-label">End Time</label>
        <input
          type="datetime-local"
          v-model="usertask.end_time"
          class="form-control"
          id="end_time"
          placeholder="Enter End Time"
        />
        <!---If error occurs-->
        <div v-if="errors.end_time">
          <span class="text-sm text-danger">{{ errors.end_time[0] }}</span>
        </div>
      </div>

      <!---enter remarks-->
      <div class="mb-3">
        <label for="Remarks" class="form-label">Remarks</label>
        <textarea class="form-control" v-model="usertask.remarks" id="remarks" rows="3"></textarea>
        <!---If error occurs-->

        <div v-if="errors.remarks">
          <span class="text-sm text-danger">{{ errors.remarks[0] }}</span>
        </div>
      </div>

      <!--select tag for status id-->
      <div class="mb-3">
        <label for="Status ID" class="form-label">Status ID</label>
        <select
          v-model="usertask.status_id"
          class="form-select"
          aria-label="Default select example"
        >
          <option v-for="stst in statuses" :key="stst.id">
            {{ stst.id }}
          </option>
        </select>
        <!---If error occurs-->
        <div v-if="errors.status_id">
          <span class="text-sm text-danger">{{ errors.status_id[0] }}</span>
        </div>
      </div>
      <!---Button to submit-->
      <button type="submit" class="btn btn-primary form-control">Update</button>
    </form>
  </div>
</template>
