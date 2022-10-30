<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" height="300" width="300">
    <wellcome-comp msg="Welcome to Movies App"/>
  </div>
</template>

<script>
import {useAuth0} from "@auth0/auth0-vue";
import WellcomeComp from "@/components/WelcomeComp.vue"
import {useRouter} from "vue-router";
import {onMounted} from "vue";

export default {
  setup() {
    const router = useRouter()
    onMounted(() => {
      const { isAuthenticated } = useAuth0()
      if (isAuthenticated.value) {
        router.push("/movies")
      }
    })
  },

  components: {
    WellcomeComp,
  }
}
</script>
