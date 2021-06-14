<template>
  <form @submit.prevent="saveForm" novalidate>
    <errors-modal v-if="errors" :errors="errors" @close="errors=null"></errors-modal>
    <div class="form-group">
      <label for="exampleInputEmail1">      {{ form.name }}</label>
    </div>

    <img v-if="form.photo_url" :src="form.photo_url" height="150px">
    <div class="large-12 medium-12 small-12 cell">
      <label>Выбирите изображение
        <input type="file" id="file" ref="mainFileInput" v-on:change="handleFileMainUpload()"/>
      </label>
      <button v-on:click="submitFile()" >Загрузить</button>
    </div>

    <div class="large-12 medium-12 small-12 cell">
      <label>Отношения:
        <span v-for="item in relations">
           <br>
           <input type="radio" id="relation" :value="item.id" v-model="form.relation_id">
           <label for="relation">{{ item.name }}</label>
         </span>
      </label>
    </div>

    <div class="large-12 medium-12 small-12 cell">
      <label>Дети:
        <span v-for="item in children">
           <br>
           <input type="radio" id="children" :value="item.id" v-model="form.children_id">
           <label for="relation">{{ item.name }}</label>
         </span>
      </label>
    </div>

    <div class="large-12 medium-12 small-12 cell">
      <label>Отеношение к алкоголю:
        <span v-for="item in alcohol">
           <br>
           <input type="radio" id="alcohol" :value="item.id" v-model="form.alcohol_id">
           <label for="relation">{{ item.name }}</label>
         </span>
      </label>
    </div>

    <div class="large-12 medium-12 small-12 cell">
      <label>Отеношение к курению:
        <span v-for="item in smoking">
           <br>
           <input type="radio" id="smoking" :value="item.id" v-model="form.smoking_id">
           <label for="relation">{{ item.name }}</label>
         </span>
      </label>
    </div>

    <div class="large-12 medium-12 small-12 cell">
      <label>Телосложение:
        <span v-for="item in bodyType">
           <br>
           <input type="radio" id="body_type_id" :value="item.id" v-model="form.body_type_id">
           <label for="relation">{{ item.name }}</label>
         </span>
      </label>
    </div>

    <div class="large-12 medium-12 small-12 cell">
    <label> Моя цель:
      <span  v-for="item in targets">
           <br>
           <input type="checkbox" :id="'targets'+item.id" :name="'targets'+item.id" :value="item.id" v-model="form.target_id" >
           <label :for="'targets'+item.id" >{{ item.name }}</label>
         </span>
    </label>
    </div>
    <div class="large-12 medium-12 small-12 cell">
      <label> Мои интересы:
        <span  v-for="item in interest">
           <br>
           <input type="checkbox" :id="'interest'+item.id" :name="'interest'+item.id" :value="item.id" v-model="form.interest_id" >
           <label :for="'interest'+item.id" >{{ item.name }}</label>
         </span>
      </label>
    </div>


    <div class="form-group">
      <label> Обо мне:
        <textarea v-model="form.description"></textarea>
      </label>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Пароль</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
             v-model="form.password">
    </div>
    <div class="form-group">
      <label for="password_confirmation">Подтверждение пароля</label>
      <input type="password" class="form-control" id="password_confirmation" placeholder="Password"
             v-model="form.password_confirmation">
    </div>
    <div class="p-2 w-full mt-4">
      <button type="submit" class="btn btn-primary">Сохранить</button>
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
            relations: [],
            targets:[],
            children:[],
            alcohol:[],
            smoking:[],
            bodyType:[],
            interest: [],
            errors: null,
        }
    },
    created() {
        this.axios
            .get(`/api/profile/`)
            .then((res) => {
                this.form = res.data.data.profile;
                this.relations = res.data.data.relations;
                this.targets=res.data.data.targets;
                this.form.target_id=[]
                for (let i=0;i<res.data.data.profile.target.length;i++){
                      this.form.target_id.push(res.data.data.profile.target[i].id)
                }
                this.alcohol=res.data.data.alcohol;
                this.children=res.data.data.children;
                this.smoking=res.data.data.smoking;
                this.bodyType=res.data.data.body_type;
                this.interest=res.data.data.interest;
                this.form.interest_id=[]
                for (let i=0;i<res.data.data.profile.interest.length;i++){
                    this.form.interest_id.push(res.data.data.profile.interest[i].id)
                }


            });
    },
    methods: {
        getProfile() {

        },
        saveForm() {
            axios.post('/api/profile', this.form).then(() => {
                //    this.$router.push({name: 'home'})
                this.form = res.data.data;
                Alert("Сохранено");
                console.log('alert')
            }).catch((error) => {
                if (error.response !== undefined && error.response.status === 422) {
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
                this.errors = null;
                this.form.photo_url = response.data.photo_url;
            })
                .catch((err) => {
                    if (err.response !== undefined && err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                });

        },
    }
}
</script>
