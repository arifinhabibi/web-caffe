import ListMenuViewVue from '@/views/ListMenuView.vue'
import LoginViewVue from '@/views/LoginView.vue'
import PageNotFoundViewVue from '@/views/PageNotFoundView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/:pathMatch(.*)*',
    name: 'page-not-found',
    component: PageNotFoundViewVue
  },{
    path: '/',
    name: 'home',
    component: HomeView
  },{
    path: '/login',
    name: 'login',
    component: LoginViewVue
  },{
    path: '/list-menu',
    name: 'list-menu',
    component: ListMenuViewVue
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
