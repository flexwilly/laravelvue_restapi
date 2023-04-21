<script setup>
import useStatuses from '../../composables/statuses'
import { onMounted } from 'vue'

//what we need from the composable
const { status, getStatus, updateStatus, errors } = useStatuses()

const props = defineProps({
  id: {
    required: true,
    type: String
  }
})

onMounted(() => getStatus(props.id))
</script>
<template>
  <div class="m-5">
    <!----Call storeStatus Method to do the submit
    and get the id from the route-->
    <form
      class="border border-dark p-4 col-md-9 m-2"
      @submit.prevent="updateStatus($route.params.id)"
    >
      <h1 class="text-center">Update Status</h1>

      <!--enter name-->
      <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input
          type="text"
          v-model="status.name"
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
      <button type="submit" class="btn btn-primary form-control">Update</button>
    </form>
  </div>
</template>
