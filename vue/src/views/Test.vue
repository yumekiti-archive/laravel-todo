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
        <button @click="this.delete">delete</button>
        <button @click="this.login">login</button>

        <div>{{this.data}}</div>

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
            posts: '',
            title: '',
            detail: '',
            name: '',
            email: '',
            password: '',
        }
    },
    methods: {
        get: function () {
            axios
                .get('/api/' + this.url)
                .then(res => (this.data = res.data))
                .catch((err) => {
                    console.log(err);
                });
            console.log(this.data)
        },
        delete: function () {
            axios
                .delete('/api/' + this.url)
                .then(res => (this.data = res.data))
            console.log(this.data)
        },
        post: function () {
            const formData = {
                title: this.title,
                detail: this.detail,
                name: this.name,
                email: this.email,
                password: this.password,
            }
            axios
                .post('/api/' + this.url, formData)
                .then(res => (this.data = res.data))
            console.log(this.data)
        },
        put: function () {
            const formData = {
                title: this.title,
                detail: this.detail,
                name: this.name,
                email: this.email,
                password: this.password,
            }
            axios
                .put('/api/' + this.url, formData)
                .then(res => (this.data = res.data))
            console.log(this.data)
        },
        login() {
            const postData = {
                email: this.email,
                password: this.password,
            }
            axios.get('/api/csrf-cookie').then(() => {
                axios
                    .post('/api/' + this.url, postData)
                    .then(res => (this.data = res.data))
            });
            console.log(this.data)
        }
    },
}
</script>