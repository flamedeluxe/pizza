<template>
    <div>
        <h1 class="text-center">404</h1>
    </div>
</template>

<script>
    export default {
        name: "PageNotFound",
        mounted() {
            document.title = this.$router.currentRoute.meta.title
        }
    }
</script>

<style scoped>

</style>
