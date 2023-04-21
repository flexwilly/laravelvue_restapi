<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <!--<img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />-->

    <div class="col-xl-8 mx-auto">
      <!--<HelloWorld msg="You did it!" />-->

      <nav class="m-2 p-2">
        <RouterLink to="/" class="btn btn-warning text-white mx-2">Home</RouterLink>
        <RouterLink to="/statuses" class="btn btn-warning text-white mx-2">Statuses</RouterLink>
        <RouterLink to="/tasks" class="btn btn-warning text-white mx-2">Tasks</RouterLink>
        <RouterLink to="/userTasks" class="btn btn-warning text-white mx-2">UserTasks</RouterLink>
      </nav>
    </div>
  </header>

  <main class="col-xl-8 mx-auto">
    <RouterView />
  </main>
</template>
