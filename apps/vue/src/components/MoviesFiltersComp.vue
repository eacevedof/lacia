<template>
  <div>
     Se podrá ordenar por: nombre, año.
     Se podrá filtrar por: año, película o serie.
    
    <label for="year">year</label>
    <select v-model="selyear" id="year">
      <option v-for="year in selyear" :key="year.key">{{year.value}}</option>
    </select>
  </div>
</template>
<script>
import {onMounted, ref} from "vue"
import movies from "@/libs/providers/movies/movies-provider";
import filters from "@/libs/transformers/movies/movies-filters";


export default {
  name: "MoviesFiltersComp",
  setup() {
    //const refFilterOrder = ref("")
    //const relFilterYear = ref("")
    //const relFilterType = ref("")

    const selYears = ref([])
    const selTypes = ref([])
    const selOrder = ref([])


    onMounted(async () => {
      const films = await movies.async_find_all()?.entries
      selYears.value = filters.get_distinct_years(films)
      selTypes.value = filters.get_distinct_types(films)
      selOrder.value = filters.get_orderby_values()
      

    })

    return {
      selYears,
      selTypes,
      selOrder
    };
  }
};
</script>