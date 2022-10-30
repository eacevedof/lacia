import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import LogoutView from "@/views/LogoutView";

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/movies',
    name: 'movies',
    component: () => import('../views/MoviesView.vue')
  },
  {
    path: '/authorize',
    name: 'authorize',
    component: () => HomeView
  },
  {
    path: '/logout',
    name: 'logout',
    component: () => LogoutView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
