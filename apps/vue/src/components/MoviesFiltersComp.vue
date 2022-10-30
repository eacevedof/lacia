<template>
  <div>
    <h4>Filters</h4>
    <div>
      <label for="year">Year</label>
      <select v-model="relFilterYear" id="year">
        <option v-for="year in selYears" :key="year.key">{{year.value}}</option>
      </select>
    </div>
    <div>
      <label for="film-type">Film type</label>
      <select v-model="relFilterType" id="film-type">
        <option v-for="type in selTypes" :key="type.key">{{type.value}}</option>
      </select>
    </div>
    <div>
      <label for="order-by">Order by</label>
      <select v-model="refFilterOrder" id="order-by">
        <option v-for="order in selOrder" :key="order.key">{{order.value}}</option>
      </select>
    </div>
  </div>
</template>
<script>
import {onMounted, ref} from "vue"
import movies from "@/libs/providers/movies/movies-provider";
import filters from "@/libs/transformers/movies/movies-filters";


export default {

  setup() {
    const refFilterOrder = ref("")
    const relFilterYear = ref("")
    const relFilterType = ref("")

    const selYears = ref([])
    const selTypes = ref([])
    const selOrder = ref([])

    onMounted(async () => {
      let result = await movies.async_find_all()
      const films = result.entries

      selYears.value = filters.get_distinct_years(films)
      selTypes.value = filters.get_distinct_types(films)
      selOrder.value = filters.get_orderby_values()
    })

    return {
      selYears,
      selTypes,
      selOrder,

      refFilterOrder,
      relFilterType,
      relFilterYear
    };
  }
};
</script>