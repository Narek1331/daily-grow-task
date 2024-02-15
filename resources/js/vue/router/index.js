import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../components/Home.vue'
import NewsletterPage from '../components/Newsletter.vue'

const routes = [
    {
        path: '/',
        component: HomePage
    },
    {
        path: '/newsletter',
        component: NewsletterPage
    },
]

  const router = createRouter({
    history: createWebHistory(),
    routes
  });
  
  export default router;