<template>
  <div>
    <h2 class="text-center">Products List</h2>

    <a ></a>
    <table class="table">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Detail</th>
        <!-- <th>Actions</th> -->
      </tr>
      </thead>
      <tbody>
      <tr v-for="product in products" :key="product.id">
        <td>{{ product.id }}</td>
        <td>{{ product.name }}</td>
        <td>{{ product.detail }}</td>
        <td>
          <div class="btn-group" role="group">
            <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
            <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import ErrorsModal from "./ErrorsModal"; ErrorsModal;
export default {

    data() {
        return {
            products: []
        }
    },
    created() {
        this.axios
            .get('/api/products/')
            .then(response => {
                this.products = response.data;
            });
    },
    mounted() {
        console.log("products")
    },
    methods: {
        deleteProduct(id) {
           let  result = window.confirm("Delete product?");
           if(!result){
               return ;
           }
            this.axios
                .delete(`/api/products/${id}`)
                .then(response => {
                    let i = this.products.map(data => data.id).indexOf(id);
                    this.products.splice(i, 1)
                });
        }
    }
}
</script>
