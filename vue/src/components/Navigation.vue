<template>
    <div>
        <button><router-link :to="'/'">todo</router-link></button>
        <button><router-link :to="'/done'">done</router-link></button>
    </div>
</template>
<script>
export default {
    
}
</script>
<style scoped>
div {
    display: flex;
    justify-content: space-around;
}
</style>