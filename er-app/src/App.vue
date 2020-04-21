<template>
  <div id="app">
      <Header></Header>
      <div class="container pt-5">
        <router-view></router-view>
      </div>
      <Footer></Footer>
  </div>
</template>

<script>
import Header from './components/layout/Header'
import Footer from './components/layout/Footer'

export default {
  name: 'App',
  components: {
    Header,
    Footer
  }
}
</script>
<style>
</style>
