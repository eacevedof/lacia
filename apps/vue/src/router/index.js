import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import LogoutView from "@/views/LogoutView";
import MoviesView from "@/views/MoviesView";
import LoginView from "@/views/LoginView";

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/movies',
    name: 'movies',
    component: () => MoviesView
  },
  {
    path: '/authorize',
    name: 'authorize',
    component: () => MoviesView
  },
  {
    path: '/login',
    name: 'login',
    component: () => LoginView
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
