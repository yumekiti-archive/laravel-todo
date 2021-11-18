<template>
    <div>
        <ul>
            <li v-for="(todo, i) in this.todos" :key="i">
                <button @click="this.delete(todo.id)">done</button>
                {{todo.id}}&nbsp;:&nbsp;{{todo.title}}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'TodoList',
    props: {
        todos: Array
    },
    methods:{
        delete(id){
            this.$store.dispatch('delete', {url: 'todo/' + id});
        }
    },
}
</script>