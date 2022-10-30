<template>
  <div class="about">
    <h1>Movies page</h1>
    <ul>
      <li v-for="(movie, index) in moviesRef" :key="`mov-${index}`">
        <p>movie: {{index + 1}}</p>
        <b>title: {{ movie.title }}</b>
        <p>desc: {{ movie.description}}</p>
        <img :src="movie.images['Poster Art'].url" height="150" width="100">
      </li>
    </ul>
  </div>
</template>
<script>
import {onMounted, ref} from "vue"
import {async_find_all} from "@/libs/providers/movies/movies-provider"


export default {
  setup() {
    const moviesRef = ref([])
    onMounted(async () => {
      const movies = await async_find_all()
      moviesRef.value = movies.entries
      console.log(moviesRef.value)
    })

    return {
      moviesRef
    }
  }
}
</script>