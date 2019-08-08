<template>
  <div id="app">
    <div class='container'>
      <h2>Phone Numbers</h2>
    </div>

    <!-- Listing selects -->
    <div class='container'>
      <Index></Index>
    </div>
  </div>
</template>

<script>
import Index from '@/components/Index.vue'
export default {
  name: 'App',
  components: {Index}
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
