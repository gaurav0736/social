<template>
  <footer class="footer">
    <div class="container-fluid">
      <nav>
        <ul class="footer-menu">
          <li>
            <router-link :to="{path:'/admin/home'}">Dashboard</router-link>
          </li>
        </ul>
      </nav>
      <div class="copyright text-center">
        &copy; Coded &
        <i class="fa fa-heart heart"></i>        
        Designed by <a href="#" target="_blank">Social Box</a>.
      </div>
    </div>
  </footer>
</template>
<script>
  export default {}

</script>
<style>

</style>
