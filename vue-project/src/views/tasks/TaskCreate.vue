<script setup>
//imports
import { reactive } from 'vue'
//we are using this to retrieve status ids
import useStatuses from '../../composables/statuses'
import useTasks from '../../composables/tasks'
import { onMounted } from 'vue'

//what we need to retrieve status ids
const { getStatuses, statuses } = useStatuses()

//what we need to create tasks
const { tasks, storeTask, errors } = useTasks()

//form values
const form = reactive({
  name: '',
  description: '',
  due_date: '',
  status_id: ''
})
//also needed to retrieve status ids
onMounted(() => getStatuses())
</script>
<template>
  <div class="m-5">
    <!----Call storeStatus Method to do the submit-->
    <form class="border border-dark p-4 col-md-9 m-2" @submit.prevent="storeTask(form)">
      <h1 class="text-center">Create Task</h1>
      <!--enter name-->
      <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input
          type="text"
          v-model="form.name"
          class="form-control"
          id="name"
          placeholder="Enter Name"
        />
        <!---If error occurs-->
        <div v-if="errors.name">
          <span class="text-sm text-danger">{{ errors.name[0] }}</span>
        </div>
      </div>
      <!---enter description-->
      <div class="mb-3">
        <label for="Description" class="form-label">Description</label>
        <input
          type="text"
          v-model="form.description"
          class="form-control"
          id="name"
          placeholder="Enter Description"
        />
        <!---If error occurs-->
        <div v-if="errors.description">
          <span class="text-sm text-danger">{{ errors.description[0] }}</span>
        </div>
      </div>
      <!--due date-->
      <div class="mb-3">
        <label for="Due Date" class="form-label">Due Date</label>
        <input
          type="datetime-local"
          v-model="form.due_date"
          class="form-control"
          id="name"
          placeholder="Enter Date"
        />
        <!---If error occurs-->
        <div v-if="errors.due_date">
          <span class="text-sm text-danger">{{ errors.due_date[0] }}</span>
        </div>
      </div>
      <!--select tag for status id-->
      <div class="mb-3">
        <label for="Status ID" class="form-label">Status ID</label>
        <select v-model="form.status_id" class="form-select" aria-label="Default select example">
          <option v-for="tsk in statuses" :key="tsk.id">
            {{ tsk.id }}
          </option>
        </select>
        <!---If error occurs-->
        <div v-if="errors.status_id">
          <span class="text-sm text-danger">{{ errors.status_id[0] }}</span>
        </div>
      </div>
      <!---Button to submit-->
      <button type="submit" class="btn btn-primary form-control">Store</button>
    </form>
  </div>
</template>
