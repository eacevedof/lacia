<template>
  <div>
    <button @click="logout">Log out</button>
  </div>
</template>
<script>
import { useAuth0 } from '@auth0/auth0-vue';

const ENV = process.env

export default {
  setup() {
    const { logout } = useAuth0();

    return {
      logout: () => {
        logout({ returnTo: ENV.VUE_APP_AUTH0_LOGOUT_CALLBACK });
      }
    };
  }
};
</script>