<template>
  <div class="about">
    <h1>Movies page</h1>
    <div>
      <movies-filters-comp/>
    </div>
    <ul>
      <li v-for="(movie, index) in moviesRef" :key="`mov-${index}`">
        <p>movie: {{index + 1}}</p>
        <b>title: {{ movie.title }} {{movie.releaseYear}} {{movie.programType}}</b>
        <p>desc: {{ movie.description}}</p>
        <a :href="movie.images['Poster Art'].url" target="_blank">
          <img :src="movie.images['Poster Art'].url" height="150" width="100">
        </a>
      </li>
    </ul>
  </div>
</template>
<script>
import {onMounted, ref, watch} from "vue"
import movies from "@/libs/providers/movies/movies-provider"
import MoviesFiltersComp from "@/components/MoviesFiltersComp";
import {useStore} from "vuex";
import filters from "@/libs/transformers/movies/movies-filters";

export default {
  setup() {
    const store = useStore()
    let allmovies = []
    const moviesRef = ref([])

    onMounted(async () => {
      const result = await movies.async_find_all()
      allmovies = result.entries
      moviesRef.value = [...allmovies]
    })

    watch(() => store.getters.get_filter_order, function() {
      const order = store.state.movies.filters.order
      console.log("order",order)

      if(order==="Year") {
        moviesRef.value = filters.get_ordered_by_year(order, allmovies)
        return
      }
      alert("by name")
      moviesRef.value = filters.get_ordered_by_name(order, allmovies)
    })

    watch(() => store.getters.get_filter_type, function() {
      const type = store.state.movies.filters.type
      console.log("type",type)
      moviesRef.value = filters.get_filtered_by_type(type, allmovies)
    })

    watch(() => store.getters.get_filter_year, function() {
      const year = store.state.movies.filters.year
      console.log("year",year)
      moviesRef.value = filters.get_filtered_by_year(year, allmovies)
    })

    return {
      moviesRef
    }
  },
  components: {
    MoviesFiltersComp
  }
}
</script>