<template>
    <div>
        <Navigation />
        <TodoForm :putStatus="false" />
        <TodoList :todos="this.todos" :done="false" />
        {{this.todos}}
    </div>
</template>

<script>
import TodoList from '@/components/TodoList.vue'
import TodoForm from '@/components/TodoForm.vue'
import Navigation from '@/components/Navigation.vue'

export default {
    name: 'Todo',
    components: {
        TodoList,
        TodoForm,
        Navigation,
    },
    computed: {
        todos() {
            return this.$store.state.data.todo;
        },
    },
    created(){
        this.$store.state.data.todo = null
        this.$store.dispatch('get', {url: 'todo'});
    },
}
</script>