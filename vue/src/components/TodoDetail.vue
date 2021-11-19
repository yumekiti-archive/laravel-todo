<template>
    <div>
        <ul v-if="this.todo">
            <li>
                id&nbsp;:&nbsp;{{this.todo.id}}
            </li>
            <li>
                title&nbsp;:&nbsp;{{this.todo.title}}
            </li>
            <li>
                detail&nbsp;:&nbsp;{{this.todo.detail}}
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    name: 'TodoDetail',
    props: {
        todo: Object,
    },
}
</script>