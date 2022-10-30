<template>
  <div class="about">
    <h1>Movies page</h1>
    <div>
      <movies-filters-comp/>
    </div>
    <ul>
      <li v-for="(movie, index) in moviesRef" :key="`mov-${index}`">
        <p>movie: {{index + 1}}</p>
        <b>title: {{ movie.title }}</b>
        <p>desc: {{ movie.description}}</p>
        <a :href="movie.images['Poster Art'].url" target="_blank">
          <img :src="movie.images['Poster Art'].url" height="150" width="100">
        </a>
      </li>
    </ul>
  </div>
</template>
<script>
import {onMounted, ref} from "vue"
import movies from "@/libs/providers/movies/movies-provider"
import MoviesFiltersComp from "@/components/MoviesFiltersComp";

export default {
  setup() {
    const moviesRef = ref([])

    onMounted(async () => {
      const result = await movies.async_find_all()
      moviesRef.value = result.entries
      //console.log("movies-view",moviesRef.value)
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