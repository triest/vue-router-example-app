<template>
  <div>
    <h3 class="text-center">Create Product</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="addProduct">
          <div class="form-group">
            <div v-if="errors">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div v-for="(v, k) in errors" :key="k">
                  <p v-for="error in v" :key="error" class="text-sm">
                    {{ error }}
                  </p>
                </div>
              </div>
            </div>

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
export default {
    data() {
        return {
            product: {},
            errors: null,
        }
    },
    methods: {
        addProduct() {
            this.axios
                .post('/api/products', this.product)
                .then(response => (
                    this.$router.push({name: 'home'})
                ))
                .catch(err => {
                    console.log(err.response.status)
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
