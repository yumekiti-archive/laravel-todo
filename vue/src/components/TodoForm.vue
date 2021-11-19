<template>
    <div>
        <input type="text" v-model="this.title" @keydown.enter="putStatus ? this.put(this.$route.params.id, $event.keyCode) : this.post($event.keyCode)" />
        <button @click="putStatus ? this.put(this.$route.params.id) : this.post()">
            {{putStatus ? '編集' : '作成'}}
        </button><br>
        <input type="text" v-model="this.detail" @keydown.enter="putStatus ? this.put(this.$route.params.id, $event.keyCode) : this.post($event.keyCode)" />
    </div>
</template>

<script>
export default {
    name: 'TodoForm',
    data: () => {
        return{
            title: '',
            detail: '',
        }
    },
    props: {
        putStatus: Boolean
    },
    methods: {
        post(keyCode = 13){
            if (keyCode !== 13) return;
            const formData = {
                title: this.title,
                detail: this.detail,
            }
            this.$store.dispatch('post', {url: 'todo', formData: formData});
            this.title = '';
            this.detail = '';
        },
        put(id, keyCode = 13){
            if (keyCode !== 13) return;
            const formData = {
                title: this.title,
                detail: this.detail,
            }
            this.$store.dispatch('put', {url: 'todo/' + id, formData: formData});
            this.title = '';
            this.detail = '';
        },
    }
}
</script>
