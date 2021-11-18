import { createStore } from 'vuex'
import axios from 'axios'

export default createStore({
    state: {
        data: [],
    },
    mutations: {
        set: (state, {response, url}) => {
            if(!state.data[url]){
                state.data[url] = response.data
            }else{
                state.data[url].push(response.data)
            }
        },
    },
    actions: {
    async get({ commit }, {url: url}){
        await axios
            .get('/api/' + url, {url: url})
            .then( response =>{
                commit('set', {response: response, url: url});
            })
            .catch(error => {
                console.log(error);
            });
    },
    async post({ commit }, {url: url, formData: formData}){
        formData.url = url
        await axios
            .post('/api/' + url, formData)
            .then( response =>{
                commit('set', {response: response, url: url});
            })
            .catch(error => {
                console.log(error);
            });
    },
    },
    modules: {
    }
})
