<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <WellcomeComp msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
import WellcomeComp from "@/components/WelcomeComp.vue"

export default {
  name: "HomeView",
  components: {
    WellcomeComp
  }
}
</script>
