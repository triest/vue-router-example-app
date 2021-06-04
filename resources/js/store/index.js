import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        settings:null,
    },
    getters: {
        SETTINGS: state => {
            return state.settings;
        },
    },
    mutations: {
        SET_SETTINGS: (state, payload) => {
            state.settings = payload;
        },

        ADD_SETTINGS: (state, payload) => {
            state.settings.push(payload);
        },
    },
    actions: {
        GET_SETTINGS: async (context, payload) => {
            let {data} = await axios.get('api/settings');
            context.commit('SET_SETTINGS', data);
        },

        SAVE_SETTINGS: async (context, payload) => {
            let {data} = await axios.post('api/settings');
            context.commit('ADD_SETTINGS', payload);
        },
    },
});
