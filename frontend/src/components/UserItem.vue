<template>
  <div class="users">
    <table id="customers">
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
      <tr v-for="user in users">
        <td>{{user.name}}</td>
        <td>{{user.email}} <span>{{user.id}}</span></td>
        <td>
          <edit-button class="btn" @click="showModal(user)">Edit</edit-button>
          <remove-button class="btn" @click="removeUser(user.id)">Remove</remove-button>
        </td>
      </tr>
    </table>
    <modal v-model:show="modalVisible">
      <user-edit :user="user" @edit="updateUser"></user-edit>
    </modal>
  </div>
</template>

<script>
import UserEdit from "@/components/UserEdit";
export default {
  components: {
    UserEdit
  },
  name: "UserItem",
  props: {
    users: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      modalVisible: false,
      user: Object
    }
  },
  methods: {
    showModal(user) {
      this.modalVisible = true;
      this.user = user
    },
    updateUser(user) {
      this.$emit('edit' , user)
      this.modalVisible = false;
    },
    removeUser(id) {
      this.$emit('remove', id);
      this.user = {
        name:  '',
        email: ''
      }
    }
  }
}
</script>

<style scoped>
.users {
  padding: 15px;
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>