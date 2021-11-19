<template>
    <div>
        <ul>
            <li v-for="(todo, i) in this.todos" :key="i">
                <button @click="done ? this.forceDelete(todo.id) : this.delete(todo.id)">{{done ? 'delete' : 'done'}}</button>
                <button v-if="done" @click="this.restore(todo.id)">restore</button>
                <button v-if="!done"><router-link :to="'/todo/' + todo.id">detail</router-link></button>
                {{todo.id}}&nbsp;:&nbsp;{{todo.title}}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'TodoList',
    props: {
        todos: Array,
        done: Boolean,
    },
    methods:{
        delete(id){
            this.$store.dispatch('delete', {url: 'todo/' + id});
        },
        forceDelete(id){
            this.$store.dispatch('delete', {url: 'todo/forceDelete/' + id});
        },
        restore(id){
            this.$store.dispatch('get', {url: 'todo/restore/' + id});
        },
    },
}
</script>