<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <wellcome-comp msg="Welcome to Your Vue.js App"/>
    <login-comp />
    <logout-comp />
  </div>
</template>

<script>
import WellcomeComp from "@/components/WelcomeComp.vue"
import LoginComp from "@/components/LoginComp"
import LogoutComp from "@/components/LogoutComp"

export default {
  name: "HomeView",
  components: {
    WellcomeComp,
    LoginComp,
    LogoutComp,
  }
}
</script>
