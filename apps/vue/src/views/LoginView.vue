<template>
  <div> Auth0 Login page</div>
</template>
<script>
import {useRouter} from "vue-router";
import { useAuth0 } from "@auth0/auth0-vue"
export default {
  setup() {
    const { loginWithRedirect, isAuthenticated } = useAuth0();
    if (!isAuthenticated.value) loginWithRedirect()
    const router = useRouter()
    router.push("/movies")
  }
};
</script>