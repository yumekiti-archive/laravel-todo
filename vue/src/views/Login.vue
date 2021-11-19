<template>
    <div>
        
    </div>
</template>
<script>
import axios from 'axios'

export default {
    created() {
        const formData = {
            email: 'test1@test.jp',
            password: 'testtest',
        }
        axios.get('/api/csrf-cookie').then(() => {
            axios
                .post('/api/login', formData)
                .then(res => (this.data = res.data))
        });
        this.$router.push('todo')
    },
}
</script>