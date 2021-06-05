<template>
  <form @submit.prevent="saveForm" novalidate>
    <errors-modal v-if="errors" :errors="errors"  @close="errors=null"></errors-modal>
    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
     {{form.name}}
    </div>

    <img :src="'/storage/'+form.photo_url" height="150px">
    <div class="large-12 medium-12 small-12 cell">
      <label>Выбирите изображение
        <input type="file" id="file" ref="mainFileInput" v-on:change="handleFileMainUpload()"/>
      </label>
      <button v-on:click="submitFile()">Загрузить</button>
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
                password_confirmation: '',
                mainFile: '',
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
                if (error.response!==undefined && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            })
        },
        handleFileMainUpload() {
            this.mainFile = this.$refs.mainFileInput.files[0];
        },
        submitFile() {
            /*
                    Initialize the form data
                */
            let formData = new FormData();
            formData.append('file', this.mainFile);
            axios.post('/api/profile/main-photo/upload',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response => {
                this.errors=null;
                this.form.photo_url=response.data.photo_url;
            })
                .catch((err) => {
                    if (err.response!==undefined && err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                });

        },
    }
}
</script>
