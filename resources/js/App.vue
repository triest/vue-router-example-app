<template>
  <div class="container">
    <ul>
      <li>    <router-link :to="{name: 'profile'}" >Профиль</router-link></li>
      <li><a href="#news">News</a></li>
      <li><a href="#contact">Contact</a></li>
      <li><a href="#about">About</a></li>
    </ul>

    <div style="margin-left:30%;padding:1px 16px;height:1000px;">
      <router-view></router-view>
    </div>

  </div>
</template>

<script>
import ErrorsModal from "./components/ErrorsModal";
import {mapGetters} from 'vuex';

export default {
    components:{
        ErrorsModal
    },
    data() {
        return {

        }
    },
    computed : {

        ...mapGetters(['SETTINGS']),

    },
    mounted() {

    },

    methods: {

        clouseModal(){
            console.log("clouse")
        },
        getSettings(){
            console.log(this.GET_SETTINGS)
            console.log(this.$store['SETTINGS'])
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

