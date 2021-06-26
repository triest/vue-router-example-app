import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        settings:[],
        user:[]
    },
    getters: {
        get_settings(state){
            return state.settings;
        },
        get_user(state){
            return state.user
        }
    },
    mutations: {
        settings(state,data) {
            return state.settings = data
        },
        set_settings(state, {key, value}) {
        //    return state.settings = data
            Vue.set(state.settings, key, value);
        },
        user(state,data) {
            return state.user = data
        },
        set_user(state, {key, value}) {
            Vue.set(state.user, key, value);
        }
    },
    actions: {
        GET_SETTINGS(context){
            axios.get("/api/settings")
                .then((response)=>{
                    context.commit("settings",response.data.settings) //categories will be run from mutation
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },


        SAVE_SETTINGS ({commit},key, value) {
            console.log(key)
            let response = axios.post('/api/settings', key);
            commit('set_settings', {key,value});
            return response.data;
        },
        GET_USER(context){
            axios.get("/api/user")
                .then((response)=>{
                    context.commit("user",response.data.user) //categories will be run from mutation
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },


        SAVE_USER ({commit},key, value) {
            let response = axios.post('/api/user', key);
            commit('set_user', {key,value});
            return response.data;
        },
    },
});
