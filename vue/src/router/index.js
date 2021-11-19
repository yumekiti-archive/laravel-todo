import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Test from '../views/Test.vue'
import Todo from '../views/Todo.vue'
import Done from '../views/Done.vue'
import Detail from '../views/Detail.vue'

const routes = [
  {
    path: '/',
    redirect: '/todo'
  },
  {
    path: '/todo',
    name: 'Todo',
    component: Todo
  },
  {
    path: '/todo/:id',
    name: 'Detail',
    component: Detail
  },
  {
    path: '/done',
    name: 'Done',
    component: Done
  },
  {
    path: '/test',
    name: 'Test',
    component: Test
  },
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
