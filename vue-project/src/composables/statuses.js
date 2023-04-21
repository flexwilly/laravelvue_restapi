//Logic here
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
//the base url for the requests
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'

export default function useStatuses() {
  //initialize with empty array  for all statuses
  const statuses = ref([])
  //for a single status
  const status = ref([])
  //holding errors
  const errors = ref([])

  //handles where to redirect
  const router = useRouter()

  //get all statuses
  const getStatuses = async () => {
    const response = await axios.get('status')
    //return array
    statuses.value = response.data
  }

  //get a single status
  const getStatus = async (id) => {
    const response = await axios.get('status/' + id)
    //return array of data
    status.value = response.data
  }

  //create a status
  const storeStatus = async (data) => {
    try {
      await axios.post('status', data)
      //redirect to StatusIndexRoute after insert
      await router.push({ name: 'StatusIndex' })
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  //function to update status
  const updateStatus = async (id) => {
    try {
      await axios.put('status/' + id, status.value)
      //redirect to StatusIndexRoute after update
      await router.push({ name: 'StatusIndex' })
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const destroyStatus = async (id) => {
    if (!window.confirm('Are you sure?')) {
      return
    }
    await axios.delete('status/' + id)
    await getStatuses()
  }

  //return the different methods
  //return the constants
  return {
    status,
    statuses,
    getStatus,
    getStatuses,
    storeStatus,
    updateStatus,
    destroyStatus,
    errors
  }
}
