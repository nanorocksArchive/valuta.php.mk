<template>
   <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <router-link class="navbar-brand font-weight-light" to="/">ER APP</router-link>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav text-uppercase font-weight-light">
              <li class="nav-item">
                <router-link class="nav-link" exact-active-class="active" to="/">About</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" exact-active-class="active" to="/list">List</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" exact-active-class="active" to="/convert">Convert</router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" exact-active-class="active" to="/history">History</router-link>
              </li>
            </ul>
          </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style>

</style>