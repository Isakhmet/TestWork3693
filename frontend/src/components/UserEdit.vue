<template>
  <form @submit.prevent>
    <h4>Edit user</h4>
    <input
        v-model="user.name"
        type="text"
        class="input"
        placeholder="name"
    >
    <span class="floating-placeholder" v-if="msg.name">{{msg.name}}</span>
    <input
        v-model="user.email"
        readonly
        type="text"
        class="input"
        placeholder="email"
    >
    <edit-button :disabled="isDisabled" class="btn" @click="updateUser">Change</edit-button>
  </form>
</template>

<script>
export default {
  name: "UserEdit",
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      msg: [],
      isDisabled: false
    }
  },
  methods: {
    updateUser() {
      if(this.validateName()) {
        this.$emit('edit', this.user);
      }
    },
    validateName() {
      if (this.user.name.length < 1) {
        this.msg['name'] = 'Please enter a name';
        return false;
      }else {
        this.msg['name'] = '';
        return true;
      }
    }
  }
}
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
}

.input {
  width: 100%;
  border: 1px solid #05c409;
  padding: 10px 15px;
  margin-top: 15px;
}

.btn {
  margin-top: 15px;
  align-self: flex-end;
}

.floating-placeholder {
  color: red;
}
</style>