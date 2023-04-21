<script setup>
//imports
import { reactive } from 'vue'
import useStatuses from '../../composables/statuses'

//what we need
const { storeStatus, errors } = useStatuses()

const form = reactive({
  name: ''
})
</script>
<template>
  <div class="m-5">
    <!----Call storeStatus Method to do the submit-->
    <form class="border border-dark p-4 col-md-9 m-2" @submit.prevent="storeStatus(form)">
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
      <!---Button to submit-->
      <button type="submit" class="btn btn-primary form-control">Store</button>
    </form>
  </div>
</template>
