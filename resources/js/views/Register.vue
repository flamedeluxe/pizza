<template>
    <div class="row text-center">
        <form class="form-signin col-12 col-lg-4 offset-lg-4">
            <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
            <div class="form-group">
                <label for="inputName" class="sr-only">Name</label>
                <input type="text" id="inputName"
                       v-model="form.name"
                       placeholder="Name"
                       :class="`form-control ${error(errors, 'name') ? 'is-invalid' : ''}`"
                >
                <div class="invalid-feedback">
                    {{ error(errors, 'name') }}
                </div>
            </div>
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
            <div class="form-group">
                <label for="inputPasswordRepeat" class="sr-only">Password repeat</label>
                <input type="password" id="inputPasswordRepeat"
                       v-model="form.password_repeat"
                       placeholder="Password repeat"
                       :class="`form-control ${error(errors, 'password_repeat') ? 'is-invalid' : ''}`"
                >
                <div class="invalid-feedback">
                    {{ error(errors, 'password_repeat') }}
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data: () => ({
            form: {
                name: '',
                email: '',
                password: '',
                password_repeat: ''
            },
            errors: {},
            message: '',
            loading: false
        }),
        methods: {
            async submit() {
                this.loading = true
                try {
                    const {data} = await axios.post(`/api/register`)
                    console.log(data)
                    this.loading = false
                    return data
                }catch (e) {
                    console.log('server error')
                }
            }
        }
    }
</script>

<style scoped>

</style>
