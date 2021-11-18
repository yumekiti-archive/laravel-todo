<template>
    <div>
        <ul>
            <li v-for="(todo, i) in this.todos" :key="i">
                {{todo.title}}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'TodoList',
    props: {
        todos: Array
    }
}
</script>