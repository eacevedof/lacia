<template>
  <div>
     Se podrá ordenar por: nombre, año.
     Se podrá filtrar por: año, película o serie.
    <input type="text" name="">
    <select>

    </select>
  </div>
</template>
<script>
import {onMounted, ref} from "vue"
import movies from "@/libs/providers/movies/movies-provider";



export default {
  setup() {
    const refFilterOrder = ref("")
    const relFilterYear = ref("")
    const relFilterType = ref("")

    const moviesRef = ref([])
    onMounted(async () => {
      const result = await movies.async_find_all()
      moviesRef.value = result.entries

    })

    return {
      logout: () => {
        logout({ returnTo: ENV.VUE_APP_AUTH0_LOGOUT_CALLBACK });
      }
    };
  }
};
</script>