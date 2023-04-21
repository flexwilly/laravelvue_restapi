//Logic here
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
//the base url for the requests
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'

export default function useUserTasks() {
  //initialize with empty array  for all user tasks
  const usertasks = ref([])
  //for a single user task
  const usertask = ref([])
  //holding errors
  const errors = ref([])

  //handles where to redirect
  const router = useRouter()

  //get all user tasks
  const getUserTasks = async () => {
    const response = await axios.get('userTasks')
    //return array
    usertasks.value = response.data
  }

  //get a single user task
  const getUserTask = async (id) => {
    const response = await axios.get('userTasks/' + id)
    //return array of data
    usertask.value = response.data
  }

  //create a task
  const storeUserTask = async (data) => {
    try {
      await axios.post('userTasks', data)
      //redirect to StatusIndexRoute after insert
      await router.push({ name: 'UserTaskIndex' })
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  //function to update a user task
  const updateUserTask = async (id) => {
    try {
      await axios.put('userTasks/' + id, usertask.value)
      //redirect to StatusIndexRoute after update
      await router.push({ name: 'UserTaskIndex' })
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  //function to softdelete a user task
  const destroyUserTask = async (id) => {
    if (!window.confirm('Are you sure?')) {
      return
    }
    await axios.delete('userTasks/' + id)
    await getUserTasks()
  }

  //return the different methods
  //return the constants
  return {
    usertask,
    usertasks,
    getUserTask,
    getUserTasks,
    storeUserTask,
    updateUserTask,
    destroyUserTask,
    errors
  }
}
