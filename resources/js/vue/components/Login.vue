<!-- Login.vue -->
<template>
    <div>
      <h2>Login</h2>
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" v-model="email">
          <div v-if="error && error.email" class="text-danger">{{ error.email[0] }}</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="password">
          <div v-if="error && error.password" class="text-danger">{{ error.password[0] }}</div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: ''
      }
    },
    computed: {
      error() {
        return this.$store.state.error
      }
    },
    methods: {
      handleSubmit() {
        this.$store.dispatch('login', {
          email: this.email,
          password: this.password
        })
      }
    }
  }
  </script>
  