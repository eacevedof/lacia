<template>
  <div>
    <p>...logging out</p>
  </div>
</template>
<script>
import { useAuth0 } from '@auth0/auth0-vue';
const ENV = process.env
export default {
  setup() {
    const { logout } = useAuth0();
    logout({ returnTo: ENV.VUE_APP_AUTH0_LOGOUT_CALLBACK })
    return {}
  }
}
</script>