<template>
  <form @submit.prevent>
    <h4>Create user</h4>
    <input
        v-model="user.name"
        type="text"
        class="input"
        placeholder="name"
    >
    <span class="floating-placeholder" v-if="msg.name">{{msg.name}}</span>
    <input
        v-model="user.email"
        type="text"
        class="input"
        placeholder="email"
    >
    <span class="floating-placeholder" v-if="msg.email">{{msg.email}}</span>
    <create-button :isDisabled="isDisabled" class="btn" @click="createUser">Create</create-button>
  </form>
</template>

<script>
export default {
  name: "UserForm",
  data() {
    return {
      user: {
        name:  '',
        email: ''
      },
      isDisabled: false,
      msg: [],
      validate: false
    }
  },
  methods: {
    createUser() {
      this.validateFields();

      if(this.validate) {
        this.$emit('create', this.user);
        this.user = {
          name:  '',
          email: ''
        }
      }
    },
    validateFields() {
      this.validate = this.validateEmail() && this.validateName();
    },
    validateEmail() {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) {
        this.msg['email'] = '';
        return true;
      } else {
        this.msg['email'] = 'Please enter a valid email address';
        return false;
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