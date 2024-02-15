<!-- components/UserList.vue -->
<template>
    <div>
      <input type="text" v-model="searchQuery" placeholder="Search users" class="form-control mb-3">
      <table class="table">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Date of Birth</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in filteredUsers" :key="user.id">
            <td>{{ user.full_name }}</td>
            <td>{{ user.phone_number }}</td>
            <td>{{ user.dob }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    computed: {
      users() {
        return this.$store.state.users;
      },
      filteredUsers() {
        if (!this.searchQuery) {
          return this.users;
        }
        const query = this.searchQuery.toLowerCase();
        return this.users.filter(user =>
          user.full_name.toLowerCase().includes(query) ||
          user.phone_number.includes(query) ||
          user.dob.includes(query)
        );
      },
    },
    data() {
      return {
        searchQuery: '',
      };
    },
    created() {
      this.$store.dispatch('fetchUsers');
    },
  };
  </script>
  