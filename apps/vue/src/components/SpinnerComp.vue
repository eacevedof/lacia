<template>
  <div v-show="show">
    <img alt="spinner" src="../assets/spinner.png" height="300" width="300">
  </div>
</template>
<script>
export default {
  props: {
    show: Boolean
  }
};
</script>