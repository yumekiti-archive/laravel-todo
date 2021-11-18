<template>
    <div>
        <TodoForm />
        <TodoList :todos="this.todos" />
    </div>
</template>

<script>
import TodoList from '@/components/TodoList.vue'
import TodoForm from '@/components/TodoForm.vue'

export default {
    name: 'Todo',
    components: {
        TodoList,
        TodoForm,
    },
    computed: {
        todos() {
            return this.$store.state.data.todo;
        },
    },
    created(){
        this.$store.dispatch('get', {url: 'todo'});
    },
}
</script>