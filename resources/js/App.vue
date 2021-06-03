<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <router-link to="/" class="nav-item nav-link">Products List</router-link>
          <router-link to="/create" class="nav-item nav-link">Create Product</router-link>
          <button v-on:click="logout()">Logout</button>
        </div>
      </div>
    </nav>

    <router-view> </router-view>
  </div>
</template>

<script>
import ErrorsModal from "./components/ErrorsModal";

export default {
    components:{
        ErrorsModal
    },
    data() {
        return {

        }
    },

    methods: {
        clouseModal(){
            console.log("clouse")
        },
        logout() {
            this.axios
                .post('/logout')
                .then(response => (
                   // this.$router.push({name: 'home'})
                    window.location.href = "/"
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
