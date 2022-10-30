<template>
  <div class="movies">
    <h1>Movies</h1>
    <spinner-comp :show="spinnerRef" />
    <div v-show="!spinnerRef">
      <movies-filters-comp/>
      <h2>Items found: <span style="color:blue">{{numMoviesRef}}</span></h2>
      <ul>
        <li v-for="(movie, index) in moviesRef" :key="`mov-${index}`">
          <p>
            ({{index + 1}})
            <b>title: {{ movie.title }}</b>  <span style="color:purple">{{movie.releaseYear}}</span>  <span style="color:green;">{{movie.programType}}</span>
          </p>
          <p>desc: {{ movie.description}}</p>
          <a :href="movie.images['Poster Art'].url" target="_blank">
            <img :src="movie.images['Poster Art'].url" height="150" width="100">
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import {useRouter} from "vue-router"
import {onMounted, ref, watch} from "vue"
import movies from "@/libs/providers/movies/movies-provider"
import MoviesFiltersComp from "@/components/MoviesFiltersComp";
import SpinnerComp from "@/components/SpinnerComp";
import {useStore} from "vuex";
import filters from "@/libs/transformers/movies/movies-filters";
import {useAuth0} from "@auth0/auth0-vue";

//const ENV = process.env

export default {

  setup() {
    const { isAuthenticated } = useAuth0()
    const router = useRouter()

    if (!isAuthenticated.value) {
      router.push("/")
    }

    const store = useStore()
    let allmovies = []
    const spinnerRef = ref(true)
    const moviesRef = ref([])
    const numMoviesRef = ref(0)

    onMounted(async () => {
      const result = await movies.async_find_all()
      allmovies = result.entries
      numMoviesRef.value = allmovies.length
      moviesRef.value = [...allmovies]
      spinnerRef.value = false
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
      numMoviesRef,
      spinnerRef,
      isAuthenticated,
    }
  },

  components: {
    MoviesFiltersComp,
    SpinnerComp,
  }
}
</script>