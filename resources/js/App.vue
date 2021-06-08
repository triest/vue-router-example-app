<template>
  <div class="container">
    <ul>
      <li>    <router-link :to="{name: 'profile'}" >Профиль</router-link></li>
      <li> <router-link :to="{name: 'dating'}" >Знакомства</router-link></li>
      <li><a href="#contact">Contact</a></li>
      <li><a href="#about">About</a></li>
    </ul>
    <button class="btn btn-primary" v-on:click="example()">Example</button>

    <div style="margin-left:30%;padding:1px 16px;height:1000px;">
      <router-view></router-view>
    </div>

  </div>
</template>

<script>
import ErrorsModal from "./components/ErrorsModal";
import {mapGetters} from 'vuex';
import {mapActions} from 'vuex';

export default {
    components:{
        ErrorsModal
    },
    data() {
        return {

        }
    },
    computed : {
          getSettings: {
              get: function () {
                  return this.$store.getters.get_settings
              },
              set:function (newValue){
                  this.$store.dispatch('SAVE_SETTINGS',newValue)
              }
          },
    },
    mounted() {
        this.$store.dispatch('GET_SETTINGS')
        this.$store.dispatch('SAVE_SETTINGS')
    },

    methods: {
        ...mapActions('SAVE_SETTINGS'),
        example(){
            console.log("example");
         //   console.log(this.getSettings);

            console.log(this.getSettings['id']);
            console.log(this.getSettings['color']);
            console.log(this.getSettings['user_id']);

        //    this.$store.commit('set_settings',{key: 'color', value: 'gren'});
            this.getSettings={ 'color': 'green'}
            this.getSettings={ 'id': 3}
            this.getSettings={ 'user_id': 2}



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
        },

    }
}
</script>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: auto;
    background-color: #f1f1f1;
    position: fixed;
  /*  height: 100%;*/
    margin-top: 5%;
    margin-left: 10%;
    overflow: auto;
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

li a.active {
    background-color: #04AA6D;
    color: white;
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
</style>

