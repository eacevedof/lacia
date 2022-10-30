<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" height="300" width="300">
    <wellcome-comp msg="Welcome to Movies App"/>
  </div>
</template>

<script>
import WellcomeComp from "@/components/WelcomeComp.vue"

export default {
  name: "HomeView",
  components: {
    WellcomeComp,
  }
}
</script>
