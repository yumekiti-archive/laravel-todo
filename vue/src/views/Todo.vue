<template>
    <div>
        <input type="text" v-model="this.url" />
        <p>url is -> localhost:8080/api/{{this.url}}</p>

        <h3>todo</h3>
        <span>
            title
            <input type="text" v-model="this.title" /><br>
            detail
            <input type="text" v-model="this.detail" /><br>
        </span>

        <h3>user</h3>
        <span>
            name
            <input type="text" v-model="this.name" /><br>
            email
            <input type="text" v-model="this.email" /><br>
            password
            <input type="text" v-model="this.password" /><br>
        </span><br>

        <button @click="this.get">get</button>
        <button @click="this.post">post</button>
        <button @click="this.put">put</button>
        <button @click="this.get">delete</button>

        <div>
            <p>{{this.data}}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'Test',
    data: () => {
        return {
            url: '',
            data: null,
            title: '',
            detail: '',
            name: '',
            email: '',
            password: '',
        }
    },
    methods: {
        get: async () => {
            await axios
                .get('/api/' + this.url)
                .then(res => (this.data = res))
        },
        delete: async () => {
            await axios
                .delete('/api/' + this.url)
                .then(res => (this.data = res))
        },
        post: async () => {
            const postData = {
                title: this.title,
                detail: this.detail,
                name: this.name,
                email: this.email,
                password: this.password,
            }
            await axios
                .post('/api/' + this.url, postData)
                .then(res => (this.data = res))
        },
        put: async () => {
            const putData = {
                title: this.title,
                detail: this.detail,
                name: this.name,
                email: this.email,
                password: this.password,
            }
            await axios
                .put('/api/' + this.url, putData)
                .then(res => (this.data = res))
        },
    },
}
</script>