<template>
  <div class="about">
    <h1>Movies page</h1>
    <div>
      <movies-filters-comp/>
    </div>
    <h2>Items found: {{numMoviesRef}}</h2>
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
    const numMoviesRef = ref(0)

    onMounted(async () => {
      const result = await movies.async_find_all()
      allmovies = result.entries
      numMoviesRef.value = allmovies.length
      moviesRef.value = [...allmovies]
    })

    const apply_filters = () => {
      const {order, year, type} = store.state.movies.filters
      console.log(store.state.movies.filters, "filters apply")
      let movies = [...allmovies]
      if (order==="year") {
        movies = filters.get_ordered_by_year(movies)
      }
      if (order==="name") {
        movies = filters.get_ordered_by_name(movies)
      }
      if (year!=="") {
        movies = filters.get_filtered_by_year(year, movies)
      }
      if (type) {
        movies = filters.get_filtered_by_type(type, movies)
      }
      moviesRef.value = [...movies]
      numMoviesRef.value = movies.length
    }

    watch(() => store.getters.get_filter_order, apply_filters)
    watch(() => store.getters.get_filter_type, apply_filters)
    watch(() => store.getters.get_filter_year, apply_filters)

    return {
      moviesRef,
      numMoviesRef
    }
  },
  components: {
    MoviesFiltersComp
  }
}
</script>