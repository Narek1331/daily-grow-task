<template>
    <div id="app">
      <nav class="sidebar">
        <ul class="nav flex-column">
          <li class="nav-item" v-for="(page, index) in pages" :key="index">
            <router-link :to="page.route" class="nav-link">{{ page.title }}</router-link>
          </li>
        </ul>
      </nav>
  
      <div class="content">
        <router-view></router-view>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        pages: [
          { title: 'Home', route: '/' },
          { title: 'Newsletter', route: '/newsletter' },
          // Add more pages as needed
        ]
      };
    }
  };
  </script>
  
  <style>
  /* Sidebar styles */
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 250px;
    padding-top: 60px; /* Adjust according to your design */
    background-color: #343a40; /* Adjust to your color scheme */
    color: #fff;
  }
  
  .nav-link {
    color: #fff;
  }
  
  /* Content area styles */
  .content {
    margin-left: 250px; /* Adjust based on sidebar width */
    padding: 20px;
  }
  </style>
  