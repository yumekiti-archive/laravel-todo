<template>
    <div>
        <Navigation />
        <TodoList :todos="this.todos" :done="true" />
        {{this.todos}}
    </div>
</template>
<script>
import TodoList from '@/components/TodoList.vue'
import Navigation from '@/components/Navigation.vue'

export default {
    name: 'Done',
    components: {
        TodoList,
        Navigation,
    },
    computed: {
        todos() {
            return this.$store.state.data.todo;
        },
    },
    created(){
        this.$store.state.data.trashed = null
        this.$store.dispatch('get', {url: 'todo/trashed'});
    },
}
</script>