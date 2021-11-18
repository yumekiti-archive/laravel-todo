<template>
    <div>
        <input type="text" v-model="this.title" @keydown.enter="this.post($event.keyCode)" />
        <button @click="this.post()">
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
        post(keyCode = 13){
            if (keyCode !== 13) return;
            const formData = {
                title: this.title,
            }
            this.$store.dispatch('post', {url: 'todo', formData: formData});
            this.title = '';
        }
    }
}
</script>
