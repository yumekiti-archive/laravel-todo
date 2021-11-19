<template>
    <div>
        <Navigation />
        <TodoForm :putStatus="true"/>
        <TodoDetail :todo="this.todo"/>
        {{todo}}
    </div>
</template>
<script>
import TodoForm from '@/components/TodoForm.vue'
import Navigation from '@/components/Navigation.vue'
import TodoDetail from '@/components/TodoDetail.vue'

export default {
    name: 'Detail',
    components: {
        TodoForm,
        Navigation,
        TodoDetail,
    },
    computed: {
        todo() {
            return this.$store.state.data.todo;
        },
    },
    created(){
        this.$store.state.data.todo = null
        this.$store.dispatch('get', {url: 'todo/' + this.$route.params.id});
    },
}
</script>