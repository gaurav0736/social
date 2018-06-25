<template>
  <div class="option__show">
    <div class="option__header">
      <h3>{{action}} Option</h3>
      <div>
        <button class="btn btn__primary" @click="save" :disabled="isProcessing">Save</button>
         <button class="btn btn__danger" @click="remove" :disabled="isRemoving">Delete</button>
        <button class="btn" @click="$router.back()" :disabled="isProcessing">Cancel</button>

      </div>
    </div>
    <div class="option__row">
      
      <div class="option__details">
        <div class="option__details_inner">
          <div class="form__group">
              <label>Name</label>
              <input type="text" class="form__control" v-model="form.option_name">
              <small class="error__control" v-if="error.option_name">{{error.option_name[0]}}</small>
          </div>
          <div class="form__group">
              <label>Value</label>
              <textarea class="form__controln" v-model="form.option_value"></textarea>
              <small class="error__control" v-if="error.option_value">{{error.option_values[0]}}</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
  import Vue from 'vue'
  import Flash from '../helpers/flash'
  import { get, post,del } from '../helpers/api'

  export default {
    data() {
      return {
                isRemoving: false,

        form: {
        },
        error: {},
        isProcessing: false,
        initializeURL: `/api/home/create`,
        storeURL: `/api/home`,
        action: 'Home'
      }
    },
    created() {
      if(this.$route.meta.mode === 'edit') {
        this.initializeURL = `/api/home/${this.$route.params.id}/edit`
        this.storeURL = `/api/home/${this.$route.params.id}?_method=PUT`
        this.action = 'Update'
      }
      get(this.initializeURL)
        .then((res) => {
          Vue.set(this.$data, 'form', res.data.form)
        })
    },
    methods: {
      save() {
       // const form = toMulipartedForm(this.form, this.$route.meta.mode)
       const form = this.form
        post(this.storeURL, form)
            .then((res) => {
                if(res.data.saved) {
                    Flash.setSuccess(res.data.message)
                    this.$router.push(`/admin/option`)
                }
                this.isProcessing = false
            })
            .catch((err) => {
                if(err.response.status === 422) {
                    this.error = err.response.data
                }
                this.isProcessing = false
            })
      }, 
      remove() {
        this.isRemoving = false
        del(`/api/home/${this.$route.params.id}`)
          .then((res) => {
            if(res.data.deleted) {
              Flash.setSuccess('You have successfully deleted recipe!')
              this.$router.push('/admin/option')
            }
          })
      }
    
    }
  }
</script>
