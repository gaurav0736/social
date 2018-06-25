<template>
	<div class="wrapper">
    <side-bar>
      <mobile-menu slot="content"></mobile-menu>
      <sidebar-link to="/admin/overview">
        <i class="nc-icon nc-chart-pie-35"></i>
        <p>Dashboard</p>
      </sidebar-link>
      <sidebar-link to="/admin/user">
        <i class="nc-icon nc-circle-09"></i>
        <p>User Profile</p>
      </sidebar-link>
      <sidebar-link to="/admin/table-list">
        <i class="nc-icon nc-notes"></i>
        <p>Table list</p>
      </sidebar-link>
      <sidebar-link to="/admin/typography">
        <i class="nc-icon nc-paper-2"></i>
        <p>Typography</p>
      </sidebar-link>
      <sidebar-link to="/admin/icons">
        <i class="nc-icon nc-atom"></i>
        <p>Icons</p>
      </sidebar-link>
      <sidebar-link to="/admin/maps">
        <i class="nc-icon nc-pin-3"></i>
        <p>Maps</p>
      </sidebar-link>
      <sidebar-link to="/admin/notifications">
        <i class="nc-icon nc-bell-55"></i>
        <p>Notifications</p>
      </sidebar-link>
    </side-bar>
 
  </div>






	<div class="container">
		<div class="navbar">
			<div class="navbar__brand">
				<router-link to="/">Social Box</router-link>
			</div>
			<ul class="navbar__list">
				<li class="navbar__item"  v-if="guest">
					<router-link to="/admin/login">LOGIN</router-link>
				</li>
				<li class="navbar__item"  v-if="guest">
      				<router-link :to="{ name: 'Register'}">Register</router-link>
				</li>
				<li class="navbar__item"  v-if="auth">
					<router-link :to="{name: 'Option'}">Options</router-link>
				</li>
				
				<li class="navbar__item"  v-if="auth">
					<a @click.stop="logout">LOGOUT</a>
				</li>
			</ul>
		</div>
		<div class="flash flash__error" v-if="flash.error">
			{{flash.error}}
		</div>
		<div class="flash flash__success" v-if="flash.success">
			{{flash.success}}
		</div>
		
		<router-view></router-view>
		
	</div>
</template>
<script type="text/javascript">
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
	import { post, interceptors } from '../../helpers/api'
	export default {
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
				flash: Flash.state
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
			}
		}
	}
</script>
