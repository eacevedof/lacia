<template>
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/movies">Movies</router-link> |
    <router-link to="/login">Log in</router-link> |
    <router-link to="/logout">Log out</router-link>
  </nav>
  <router-view/>
</template>
<script>
import {ref} from "vue"
import {useAuth0} from "@auth0/auth0-vue";

export default {
  setup() {
    const {isAuthenticated } = useAuth0()
    const isLoggedRef = ref(false)
    console.log("app isauth", isAuthenticated.value)
    if (isAuthenticated.value) {
        isLoggedRef.value = true
    }

    return {
      isLoggedRef
    }
  }
}
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
