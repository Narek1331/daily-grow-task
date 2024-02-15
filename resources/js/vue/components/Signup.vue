<!-- Signup.vue -->
<template>
    <div>
      <h1>Signup</h1>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="signupForm.email">
          <div v-if="signupError" class="text-danger">{{ signupError }}</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="signupForm.password">
        </div>
        <div class="mb-3">
          <label for="full_name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="full_name" v-model="signupForm.full_name">
        </div>
        <div class="mb-3">
          <label for="phone_number" class="form-label">Phone Number</label>
          <input type="text" class="form-control" id="phone_number" v-model="signupForm.phone_number" placeholder="75621955165">
        </div>
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input type="text" class="form-control" id="dob" v-model="signupForm.dob" placeholder="10.02.99">
        </div>
        <button type="submit" class="btn btn-primary">Signup</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        signupForm: {
          email: '',
          password: '',
          full_name: '',
          phone_number: '',
          dob: ''
        }
      };
    },
    computed: {
      signupError() {
        return this.$store.state.signupError;
      }
    },
    methods: {
      submitForm() {
        this.$store.dispatch('signup',this.signupForm);
      }
    }
  };
  </script>
  