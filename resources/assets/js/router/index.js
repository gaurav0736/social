import Vue from 'vue'
import VueRouter from 'vue-router'
import VueSweetAlert from 'vue-sweetalert'

import App from '../App.vue'
import Dashboard from '../admin/Layout/DashboardLayout.vue'
import Login from '../admin/auth/Login.vue'
import Register from '../admin/auth/Register.vue'
import NotFoundPage from '../admin/NotFoundPage.vue'
import Home from '../admin/HomePage.vue'
import Option from '../admin/OptionShow.vue'
import OptionCreate from '../admin/OptionCreate.vue'




Vue.use(VueRouter)
Vue.use(VueSweetAlert)


const router = new VueRouter({
	mode: 'history',
  linkActiveClass: 'nav-item active',
	routes: [
		/*{ path: adminUrl, component: Login },
		{ path: adminUrl + '/register', component: Register },
		{ path: '/admin/login', component: Login },*/
		{
    path: '/',
    component: Dashboard,
    redirect: '/admin/home'
  },
  {
    path: '/admin',
    component: Dashboard,
    name: 'admin',
    redirect: '/admin/login',
    children: [   
      {
        path: 'login',
         name: 'Login',
        component: Login
      }, 
      {
        path: 'register',
         name: 'Register',
        component: Register
      },
        {
        path: 'option',
         name: 'Option',
        component: Option
      }, {
        path: 'option/create',
         name: 'OptionCreate',
        component: OptionCreate,meta:{mode:'create'}
      },{
        path: 'option/:id/edit',
         name: 'OptionEdit',
        component: OptionCreate,meta:{mode:'edit'}
      },
      { path: 'home',
         name: 'home',
        component: Home
      },{ path: '*', component: NotFoundPage }
     
    ]
  } ,  { path: '*', component: NotFoundPage }

	]

})



export default router
