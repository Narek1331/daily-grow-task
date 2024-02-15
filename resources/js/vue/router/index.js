import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../components/Home.vue'
import NewsletterPage from '../components/Newsletter.vue'
import LoginPage from '../components/Login.vue'
import SignupPage from '../components/Signup.vue'
import DefaultLayout from '../components/layouts/DefaultLayout.vue'
import PanelLayout from '../components/layouts/PanelLayout.vue'
import { authMiddleware } from '../middlewares/authMiddleware';

const routes = [
    {
      path: '/',
      redirect: '/auth/login'
    },
    {
    path: '/auth',
    component: DefaultLayout,
    children: [
      {
        path: '/auth/login',
        component: LoginPage
      },
      {
        path: '/auth/signup',
        component: SignupPage
      },
    ]
    },
    {
      path: '/panel',
      component: PanelLayout,
      children: [
        {
            path: '/panel',
            component: HomePage
        },
        {
            path: '/panel/newsletter',
            component: NewsletterPage
        },
      ],
      beforeEnter: authMiddleware 

      }
]

  const router = createRouter({
    history: createWebHistory(),
    routes
  });
  
  export default router;