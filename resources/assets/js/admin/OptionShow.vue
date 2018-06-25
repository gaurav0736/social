<template>
  <div class="recipe__list">
    <router-link :to="{name: 'OptionCreate'}">Add Options</router-link>

    <div class="recipe__item" v-for="option in option">
      <router-link class="recipe__inner" :to="`/admin/option/${option.id}/edit`">
      
        <p class="recipe__name">{{option.option_name}}:  {{option.option_value}}</p>
                  

      </router-link>


    </div>
  </div>
</template>
<script type="text/javascript">
  import { get } from '../helpers/api'
  export default {
    data() {
      return {
        option: []
      }
    },
    created() {
      get('/api/home')
        .then((res) => {
          this.option = res.data.option
        })
    },

  }
</script>
