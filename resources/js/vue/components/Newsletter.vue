<template>
    <div>
      <h1>Newsletter Form</h1>
      <form @submit.prevent="submitForm">
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="formData.name" class="form-control"/>
          <span v-if="errors.name" class="error">{{ errors.name }}</span>
        </div>
        <div>
          <label for="text">Text:</label>
          <textarea id="text" v-model="formData.text" class="form-control"></textarea>
          <span v-if="errors.text" class="error">{{ errors.text }}</span>
        </div>
        <div>
          <label for="type">Type:</label>
          <select id="type" v-model="formData.type" class="form-control">
            <option value="now">Now</option>
            <option value="daily_7_days_before_birthday">Daily 7 Days Before Birthday</option>
          </select>
          <span v-if="errors.type" class="error">{{ errors.type }}</span>
        </div>
        <div>
          <label for="users">Select Users:</label>
          <select id="users" v-model="selectedUsers" multiple class="form-control">
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.full_name }}</option>
          </select>
          <span v-if="errors.user_ids" class="error">{{ errors.user_ids }}</span>
        </div>
        <div class="text-center">
            <button type="submit" class="btn">Save</button>
        </div>
      </form>

      
      <div v-if="successMessage" class="alert alert-primary" role="alert">
        {{ successMessage }}      
      </div>

      <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        formData: {
          name: '',
          text: '',
          type: '',
        },
        users: [],
        selectedUsers: [],
        errors: {},
        successMessage: '',
        errorMessage: '',
      };
    },
    mounted() {
    this.$store.dispatch('fetchUsers');
    },
    computed: {
      users() {
        return this.$store.state.users;
      },
    },
    
    methods: {
   
      async submitForm() {
        try {
          const response = await axios.post('http://localhost/api/newsletter', {
            name: this.formData.name,
            text: this.formData.text,
            type: this.formData.type,
            user_ids: this.selectedUsers,
          });
          if (response.data.status) {
            this.successMessage = response.data.message;
            this.formData = {
              name: '',
              text: '',
              type: '',
            };
            this.selectedUsers = [];
            this.errors = {};
          } else {
            this.errorMessage = response.data.message;
            this.errors = response.data.errors;
          }
        } catch (error) {
          console.error('Error submitting form:', error);
          this.errorMessage = 'Failed to submit newsletter form.';
        }
      },
    },
  };
  </script>
  
  <style>
  .error {
    color: red;
  }
  .success {
    color: green;
  }
  </style>
  