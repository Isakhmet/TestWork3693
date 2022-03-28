<template>
  <button class="btn remove">
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "RemoveButton"
}
</script>

<style scoped>
.btn {
  margin: 5px;
  padding:    10px 15px;
  background: none;
}

.btn:hover {
  cursor: pointer;
}

.remove {
  color:  red;
  border: 1px solid red;
}
</style>