<template>
    <div>
        <h1 class="mb-5">Cart</h1>
        <cart-component
            :cart="cart"
            :rate="rate"
            :currency="currency"
            @removeItem="removeItem"
            @updateTotal="updateTotal"
            @updateCart="updateCart"
        >
        </cart-component>

        <order-component
            v-if="total"
            :rate="rate"
            :total="total"
            :currency="currency"
            @cleanCart="cleanCart"
        ></order-component>
    </div>
</template>

<script>
    import CartComponent from '../components/CartComponent';
    import OrderComponent from "../components/OrderComponent";

    export default {
        name: "Cart",
        data: () => ({
            cart: {},
            total: 0
        }),
        props: {
            complete: Boolean,
            currency: String,
            rate: String|Number
        },
        components: {
            CartComponent,
            OrderComponent
        },
        mounted() {
            document.title = this.$router.currentRoute.meta.title
            this.getCart()
        },
        methods: {
            getCart() {
                const items = JSON.parse(localStorage.getItem('__cart'))
                this.cart = items
            },
            updateTotal(total) {
                this.total = Math.round(total * this.rate)
            },
            removeItem() {
                this.getCart()
            },
            cleanCart() {
                this.cart = {}
                this.$emit('cleanCart')
            },
            updateCart() {
                this.$emit('updateCart')
            }
        }
    }
</script>

<style scoped>

</style>
