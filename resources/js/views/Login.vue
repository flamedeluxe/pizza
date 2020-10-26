<template>
    <div class="row text-center">
        <form class="form-signin col-12 col-lg-4 offset-lg-4">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" v-model="form.email">
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" v-model="form.password">
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data: () => ({
            form: {
                email: '',
                password: ''
            },
            errors: {},
            message: ''
        }),
        methods: {
            async submit() {
                try {
                    const {data} = await axios.post(`/api/login`)
                    this.loading = false
                    await this.$router.push('my-orders')
                }catch (e) {
                    console.log('server error')
                }
            }
        }
    }
</script>

<style scoped>

</style>
