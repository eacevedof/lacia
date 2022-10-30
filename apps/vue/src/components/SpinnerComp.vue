<template>
  <div v-show="show">
    <img alt="spinner" src="../assets/spinner.png" height="150" width="150">
  </div>
</template>
<script>
export default {
  props: {
    show: Boolean
  }
};
</script>