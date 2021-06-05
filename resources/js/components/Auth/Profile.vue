<template>
  <form @submit.prevent="saveForm" novalidate>
    <errors-modal v-if="errors" :errors="errors"  @close="errors=null"></errors-modal>
    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input type="email" class="form-control" id="naem" aria-describedby="emailHelp"
             placeholder="Name" v-model="form.name">
      <small id="name" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
             v-model="form.password">
    </div>
    <div class="form-group">
      <label for="password_confirmation">Password confirmation</label>
      <input type="password" class="form-control" id="password_confirmation" placeholder="Password"
             v-model="form.password_confirmation">
    </div>
    <div class="p-2 w-full mt-4">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </form>
</template>
<script>
import ErrorsModal from "../ErrorsModal";

export default {
    components: {
        ErrorsModal
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: null
        }
    },
    created() {
        this.axios
            .get(`/api/profile/`)
            .then((res) => {
                this.form = res.data.data;
            });
    },
    methods: {
        getProfile(){

        },
        saveForm() {
            axios.post('/api/profile', this.form).then(() => {
            //    this.$router.push({name: 'home'})
                this.form = res.data.data;
                alert("Сохранено")
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }else {
                    alert("Вутренняя ошибка!")
                }
            })
        }
    }
}
</script>
