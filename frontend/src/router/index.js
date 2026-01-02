import { createRouter, createWebHistory } from 'vue-router'

import Home from '@/Home.vue'
import Create from '@/Create.vue'
import Signup from '@/Signup.vue'
import Dashboard from '@/Dashboard.vue'
import Login from '@/Login.vue'
import ViewUser from '@/ViewUser.vue'
import Follows from '@/Follows.vue'
import Logout from '@/Logout.vue'
import Post from '@/Post_s.vue'
import ResetPass from '@/ResetPass.vue'

const routes = [
  {'path': '/', component: Home},
  {'path': '/create', component: Create},
  {'path': '/signup', component: Signup},
  {'path': '/dash', component: Dashboard},
  {'path': '/login', component: Login},
  {'path': '/reset', component: ResetPass},
  {'path': '/logout', component: Logout},
  {'path': '/user/:id', component: ViewUser},
  {'path': '/follows', component: Follows},
  {'path': '/post', component: Post},
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes,
  
  scrollBehavior (to, from, savedPosition) {
    return { top: 0 }
  }
})

export default router
