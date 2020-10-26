<template>
    <div>
        <h1 class="mb-5">Well done!</h1>
        Your order has been received
    </div>
</template>

<script>
    export default {
        name: "done",
        mounted() {
            document.title = this.$router.currentRoute.meta.title
        }
    }
</script>

<style scoped>

</style>
