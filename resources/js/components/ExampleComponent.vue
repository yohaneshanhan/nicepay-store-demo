<template>
  <div class="App">
    <nav class="App__nav">
      <router-link to="/home">Home</router-link> |
      <router-link to="/about">About</router-link>
    </nav>
    <router-view/>
    <footer>
      &copy; Awesome Company
    </footer>
  </div>
</template>