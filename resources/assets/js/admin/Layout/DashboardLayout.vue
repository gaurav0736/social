<template> 
  <div class="wrapper">
    <side-bar>
      <mobile-menu slot="content"></mobile-menu>
      <sidebar-link to="/admin/home">
        <i class="nc-icon nc-chart-pie-35"></i>
        <p>Dashboard</p>
      </sidebar-link>
      <sidebar-link to="/admin/option">
        <i class="nc-icon nc-atom"></i>
        <p>Options</p>
      </sidebar-link>
     
    </side-bar>
    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content @click="toggleSidebar">

      </dashboard-content>

      <content-footer></content-footer>
    </div>
  </div>

</template>
<script type="text/javascript">
  import Auth from '../../store/auth'
  import Flash from '../../helpers/flash'
  import { post, interceptors } from '../../helpers/api'
  import TopNavbar from './TopNavbar.vue'
  import ContentFooter from './ContentFooter.vue'
  import DashboardContent from './Content.vue'
  import MobileMenu from './MobileMenu.vue'
  export default {  components: {
      TopNavbar,
      ContentFooter,
      DashboardContent,
      MobileMenu
    },
   
    created() {
      // global error http handler
      interceptors((err) => {
        if(err.response.status === 401) {
          Auth.remove()
          this.$router.push('/admin/login')
        }

        if(err.response.status === 500) {
          Flash.setError(err.response.statusText)
        }

        if(err.response.status === 404) {
          this.$router.push('/admin/not-found')
        }
      })
      Auth.initialize()
    },
    data() {
      return {
        authState: Auth.state,
        flash: Flash.state,

      }
    },
    computed: {
      auth() {
        if(this.authState.api_token) {
          return true
        }
        return false
      },
      guest() {
        return !this.auth
      }
    },
    methods: {
      logout() {
        post('/api/logout')
            .then((res) => {
                if(res.data.done) {
                    // remove token
                    Auth.remove()
                    Flash.setSuccess('You have successfully logged out.')
                    this.$router.push('/admin/login')
            }
        })
      }, toggleSidebar () {
        if (this.$sidebar.showSidebar) {
          this.$sidebar.displaySidebar(false)
        }
      }
    }
  }
</script>
