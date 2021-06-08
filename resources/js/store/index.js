import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        settings:[],
    },
    getters: {
        get_settings(state){
            return state.settings;
        },
    },
    mutations: {
        settings(state,data) {
            return state.settings = data
        }
    },
    actions: {
        GET_SETTINGS(context){
            axios.get("api/settings")
                .then((response)=>{
                    context.commit("settings",response.data.settings) //categories will be run from mutation
                })
                .catch(()=>{
                    console.log("Error........")
                })
        },


        async  SAVE_SETTINGS (context, payload) {
            let {data} = await axios.post('api/settings');
            context.commit('ADD_SETTINGS', payload);
        },
    },
});
