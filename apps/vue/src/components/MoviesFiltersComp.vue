<template>
  <div>
    <h4>Filters</h4>
    <div>
      <label for="year">Year</label>
      <select v-model="relFilterYear" id="year" @change="emit_filter_applied">
        <option v-for="year in selYears" :value="year.key" :key="year.key">{{year.value}}</option>
      </select>
    </div>
    <div>
      <label for="film-type">Film type</label>
      <select v-model="relFilterType" id="film-type" @change="emit_filter_applied">
        <option v-for="type in selTypes" :value="type.key" :key="type.key">{{type.value}}</option>
      </select>
    </div>
    <div>
      <label for="order-by">Order by</label>
      <select v-model="refFilterOrder" id="order-by" @change="emit_filter_applied">
        <option v-for="order in selOrder" :value="order.key" :key="order.key">{{order.value}}</option>
      </select>
    </div>
  </div>
</template>
<script>
import {onMounted, ref} from "vue"
import movies from "@/libs/providers/movies/movies-provider";
import filters from "@/libs/transformers/movies/movies-filters";
import {useStore} from "vuex"


export default {
  //emits: ["filter_applied"],

  setup() {
    const store = useStore()
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

    const emit_filter_applied = () => {
      //console.log(relFilterType.value,refFilterOrder.value, relFilterYear.value)
      store.state.movies.filters.type = relFilterType.value
      store.state.movies.filters.order = refFilterOrder.value
      store.state.movies.filters.year = relFilterYear.value

      store.dispatch("set_order_action")
      store.dispatch("set_type_action")
      store.dispatch("set_year_action")
      //console.log("movies",store.state.movies.filters)
    }

    return {
      selYears,
      selTypes,
      selOrder,

      refFilterOrder,
      relFilterType,
      relFilterYear,

      emit_filter_applied
    };
  }
};
</script>