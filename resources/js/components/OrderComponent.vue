<template>
    <div class="mt-5 mb-5">
        <div class="row">
            <form class="card-body border" action="" @submit.prevent="order">
                <h3 class="mb-4">Order info</h3>
                <div class="row">
                    <div class="col-12 col-lg-6 form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name"
                               v-model="form.name"
                               :class="`form-control ${error(errors, 'name') ? 'is-invalid' : ''}`"
                        >
                        <div class="invalid-feedback">
                            {{ error(errors, 'name') }}
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 form-group">
                        <label for="surname">Surname</label>
                        <input type="text" id="surname"
                               v-model="form.surname"
                               :class="`form-control ${error(errors, 'surname') ? 'is-invalid' : ''}`"
                        >
                        <div class="invalid-feedback" >
                            {{ error(errors, 'surname') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone"
                               v-model="form.phone"
                               :class="`form-control ${error(errors, 'phone') ? 'is-invalid' : ''}`"
                        >
                        <div class="invalid-feedback">
                            {{ error(errors, 'phone') }}
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email"
                               v-model="form.email"
                               :class="`form-control ${error(errors, 'email') ? 'is-invalid' : ''}`"
                        >
                        <div class="invalid-feedback">
                            {{ error(errors, 'email') }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address"
                              v-model="form.address"
                              :class="`form-control ${error(errors, 'address') ? 'is-invalid' : ''}`"
                    ></textarea>
                    <div class="invalid-feedback">
                        {{ error(errors, 'address') }}
                    </div>
                </div>
                <div class="">
                    <label for="">Delivery cost:</label>
                    <b>{{ Math.round(delivery / rate) }} {{ currency }}</b>
                </div>
                <div class="mb-4">
                    <label for="">Total:</label>
                    <b>{{ Math.round(total / rate) + Math.round(delivery / rate) }} {{ currency }}</b>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-lg-6">
                        <button type="submit" class="form-control btn btn-success">
                            <i v-if="loading" class="fas fa-spinner fa-spin"></i>
                            <span v-else>Order now!</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        name: "OrderComponent",
        props: {
            currency: String|Number,
            rate: String|Number,
            total: String|Number,
        },
        components: {

        },
        data: () => ({
            form: {
                name: '',
                surname: '',
                phone: '',
                email: '',
                address: '',
                user: '',
                cart: {}
            },
            delivery: 12,
            loading: false,
            totalPrice: 0,
            errors: {},
            message: {}
        }),
        mounted() {
            this.setUserFields()
        },
        watch: {
            form: {
                deep: true,
                immediate: true,
                handler() {
                    this.errors = {}
                }
            }
        },
        methods: {
            error(errors, field) {
                return errors.hasOwnProperty(field) ? errors[field].join(',') : ''
            },
            setUserFields() {
                if(localStorage.getItem('user')) {
                    const user = JSON.parse(localStorage.getItem('user'))
                    this.form.name = user.name
                    this.form.email = user.email
                    this.form.phone = user.phone
                }
            },
            async order() {
                this.form.cart = localStorage.getItem('__cart')
                this.form.user = JSON.parse(localStorage.getItem('user'))
                this.loading = true
                this.errors = {}
                try {
                    const {data} = await axios.post(`/api/order`, this.form)
                    this.loading = false
                    this.form = {}
                    this.$emit('cleanCart')

                    this.$toast.success(data.message);

                    await this.$router.push('done')
                }catch(error) {
                    this.loading = false
                    if(error.response.status === 419) {
                        this.errors = error.response.data.errors
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
