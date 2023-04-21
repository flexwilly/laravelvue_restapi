//Logic here
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
//the base url for the requests
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'

export default function useTasks() {
  //initialize with empty array  for all tasks
  const tasks = ref([])
  //for a single task
  const task = ref([])
  //holding errors
  const errors = ref([])

  //handles where to redirect
  const router = useRouter()

  //get all tasks
  const getTasks = async () => {
    const response = await axios.get('tasks')
    //return array
    tasks.value = response.data
  }

  //get a single status
  const getTask = async (id) => {
    const response = await axios.get('tasks/' + id)
    //return array of data
    task.value = response.data
  }

  //create a task
  const storeTask = async (data) => {
    try {
      await axios.post('tasks', data)
      //redirect to StatusIndexRoute after insert
      await router.push({ name: 'TaskIndex' })
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  //function to update task
  const updateTask = async (id) => {
    try {
      await axios.put('tasks/' + id, task.value)
      //redirect to StatusIndexRoute after update
      await router.push({ name: 'TaskIndex' })
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  //function to softdelete a task
  const destroyTask = async (id) => {
    if (!window.confirm('Are you sure?')) {
      return
    }
    await axios.delete('tasks/' + id)
    await getTasks()
  }

  //return the different methods
  //return the constants
  return {
    task,
    tasks,
    getTask,
    getTasks,
    storeTask,
    updateTask,
    destroyTask,
    errors
  }
}
