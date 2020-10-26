<template>
    <div>
        <h1 class="mb-5">My orders</h1>

        <div class="mb-5">
            <a href="" class="btn btn-sm btn-danger" @click.prevent="logout">Log out</a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Delivery</th>
                    <th>Products</th>
                    <th>Created at</th>
                </tr>
                <tr v-for="order in orders" v-if="count > 0">
                    <td>{{ order.address }}</td>
                    <td>{{ order.phone }}</td>
                    <td>{{ order.status ? order.status.title : '' }}</td>
                    <td>{{ order.total }}</td>
                    <td>{{ order.delivery ? order.delivery.title : '' }}</td>
                    <td>
                       <div v-for="product in order.products" :key="product.id" v-if="order.products">
                           {{ product.title }} - {{ Math.round(product.price / rate) }} {{ currency }}
                       </div>
                    </td>
                    <td>{{ date(order.created_at) }}</td>
                </tr>
                <tr v-if="count === 0 && loading === false">
                    <td colspan="7">No orders</td>
                </tr>
                <tr v-if="loading" class="text-center">
                    <td colspan="7">Loading...</td>
                </tr>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Orders",
        props: {
            currency: String,
            cart: Object|Array,
            rate: String|Number
        },
        data: () => ({
            orders: {},
            loading: true,
            count: 0,
        }),
        mounted() {
            document.title = this.$router.currentRoute.meta.title
            this.getOrders()
        },
        methods: {
            async getOrders() {
                try {
                    if(localStorage.getItem('token'))
                        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem('token')
                    const {data} = await axios.get('/api/my-orders')

                    this.orders = data.orders
                    this.count = data.orders.length
                    this.loading = false
                }catch (error) {
                    this.loading = false
                    if(error.response.status === 419) {
                        this.errors = error.response.data.errors
                    }else if (error.response.status === 401) {
                        localStorage.removeItem('token')
                        localStorage.removeItem('user')
                    }
                    else {
                        console.log('server error')
                    }
                }
            },
            date(date) {
                date = new Date(date)
                return date.toLocaleDateString("en-US")
            },
            async logout() {
                try {
                    if(localStorage.getItem('token'))
                        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem('token')
                    const {data} = await axios.get('/api/logout')
                    this.loading = false

                    localStorage.removeItem('token')
                    localStorage.removeItem('user')
                    this.$emit('logout')
                    await this.$router.push('login')
                }catch (error) {
                    console.log('server error')
                }
            }
        }
    }
</script>

<style scoped>

</style>
