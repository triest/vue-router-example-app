<template>
  <div>
    <h3 class="text-center">Edit Product</h3>
    <div class="row">
      <errors-modal v-if="errors" :errors="errors"  @close="errors=null"></errors-modal>
      <div class="col-md-6">
        <form @submit.prevent="updateProduct">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="product.name">
          </div>
          <div class="form-group">
            <label>Detail</label>
            <input type="text" class="form-control" v-model="product.detail">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <router-link :to="{name: 'home'}" class="btn btn-success">Back</router-link>
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
        }
    },
    created() {
        this.axios
            .get(`/api/products/${this.$route.params.id}`)
            .then((res) => {
                this.product = res.data;
            });
    },
    methods: {
        updateProduct() {
            this.axios
                .patch(`/api/products/${this.$route.params.id}`, this.product)
                .then((res) => {
                    this.$router.push({ name: 'home' });
                }) .catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        }
    }
}
</script>
