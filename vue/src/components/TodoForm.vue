<template>
    <div>
        <input type="text" v-model="this.title"/>
        <button @click="this.post">
            作成
        </button>
    </div>
</template>

<script>
export default {
    name: 'TodoForm',
    data: () => {
        return{
            title: '',
        }
    },
    methods: {
        post(){
            const formData = {
                title: this.title,
            }
            this.$store.dispatch('post', {url: 'todo', formData: formData});
        }
    }
}
</script>
