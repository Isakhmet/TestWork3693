<template>
  <div class="app">
    <div class="create__user">
      <create-button class="btn" @click="showModal">Create user</create-button>
    </div>
    <modal v-model:show="modalVisible">
      <user-form @create="create"></user-form>
    </modal>
    <modal v-model:show="showErrors">
      <span class="errors" v-for="error in errors">{{error}}</span>
    </modal>
    <user-item :users="allUsers" @edit="updateUser" @remove="removeUser"></user-item>
  </div>
</template>

<script>
import UserItem from "@/components/UserItem";
import UserForm from "@/components/UserForm";
import {mapGetters, mapActions} from 'vuex';

export default {
  components: {
    UserItem, UserForm
  },
  computed:   mapGetters(['allUsers']),
  data() {
    return {
      modalVisible: false,
      isDisabled:   false,
      errors: [],
      showErrors : false
    }
  },
  async mounted() {
    this.fetchUsers();
  },
  methods:    {
    ...mapActions(['fetchUsers']),
    create(user) {
      this.$store.dispatch('createUser', user).then((res) => {
        this.errors = res.message
        this.showErrors = true
      }).catch((error) => {
        this.errors = error
        this.showErrors = true
      })

      this.modalVisible = false;
    },
    updateUser(user) {
      this.$store.dispatch('updateUser', user).then((res) => {
        this.errors = res.message
        this.showErrors = true
      }).catch((error) => {
        this.errors = error
        this.showErrors = true
      })
    },
    removeUser(id) {
      console.log(id)
      this.$store.dispatch('deleteUser', id).then((res) => {
        this.errors = res.message
        this.showErrors = true
      }).catch((error) => {
        this.errors = error
        this.showErrors = true
      })
    },
    showModal() {
      this.modalVisible = true;
    }
  }
}
</script>

<style>
* {
  margin:     0;
  padding:    0;
  box-sizing: border-box;
}

.app {
  padding: 15px;
}

.errors {
  color: red;
}
</style>
