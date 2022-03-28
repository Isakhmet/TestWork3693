<template>
  <button :disabled="isDisabled" class="btn create">
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "CreateButton",
  props: {
    isDisabled: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style scoped>
.btn {
  margin-left: 15px;
  padding:    10px 15px;
  background: none;
}

.btn:hover {
  cursor: pointer;
}

.create {
  color:  #05c409;
  border: 1px solid #05c409;
}
</style>