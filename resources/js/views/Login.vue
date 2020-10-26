<template>
    <div class="row text-center">
        <form class="form-signin col-12 col-lg-4 offset-lg-4" @submit.prevent="submit">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail"
                       v-model="form.email"
                       placeholder="Email address"
                       :class="`form-control ${error(errors, 'email') ? 'is-invalid' : ''}`"
                >
                <div class="invalid-feedback">
                    {{ error(errors, 'email') }}
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword"
                       v-model="form.password"
                       placeholder="Password"
                       :class="`form-control ${error(errors, 'password') ? 'is-invalid' : ''}`"
                >
                <div class="invalid-feedback">
                    {{ error(errors, 'password') }}
                </div>
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
            message: '',
            loading: false
        }),
        methods: {
            error(errors, field) {
                return errors.hasOwnProperty(field) ? errors[field].join(',') : ''
            },
            async submit() {
                try {
                    const {data} = await axios.post(`/api/login`, this.form)
                    localStorage.setItem('token', data.token.plainTextToken)
                    localStorage.setItem('user', JSON.stringify(data.user))

                    this.loading = false

                    this.$emit('setUser')
                    await this.$router.push('my-orders')
                }catch (error) {
                    this.loading = false
                    if(error.response.status === 419) {
                        this.message = error.response.data.message
                        this.$toast.error(this.message);
                    }else {
                        console.log('server error')
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
