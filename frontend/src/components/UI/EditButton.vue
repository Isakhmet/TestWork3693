<template>
  <button :disabled="isDisabled" class="btn edit">
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "EditButton",
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
  margin: 5px;
  padding:    10px 15px;
  background: none;
}

.btn:hover {
  cursor: pointer;
}

.edit {
  color:  #e7861e;
  border: 1px solid #e7861e;
}
</style>