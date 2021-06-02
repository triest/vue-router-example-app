<template>
  <div>
    <h3 class="text-center">Create Product</h3>
    <div class="row">
      <errors-modal v-if="errors" :errors="errors"  @close="errors=null"></errors-modal>
      <div class="col-md-6">
        <form @submit.prevent="addProduct">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="product.name">
          </div>
          <div class="form-group">
            <label>Detail</label>
            <input type="text" class="form-control" v-model="product.detail">
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import ErrorsModal from "./ErrorsModal";
export default {
    components:{
        ErrorsModal
    },
    data() {
        return {
            product: {},
            errors: null,
            modalOpen: true
        }
    },

    methods: {
        clouseModal(){
            console.log("clouse")
        },
        addProduct() {
            this.axios
                .post('/api/products', this.product)
                .then(response => (
                    this.$router.push({name: 'home'})
                ))
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
