<template>
    <div>
        <h1 class="mb-5">Catalog</h1>

        <div class="row">
            <product
                v-for="product in products"
                :key="product.id"
                :product="product"
                :currency="currency"
                @updateCart="updateCart"
            ></product>
        </div>

    </div>
</template>

<script>
    import {add, total} from "cart-localstorage";
    import product from '../components/ProductComponent';

    export default {
        name: "Index",
        data: () => ({
            products: {},
            loading: false
        }),
        props: {
            currency: String
        },
        components: {
            add, total,
            product
        },
        computed: {

        },
        async mounted() {
            this.products = await this.loadProducts()

        },
        methods: {
            async loadProducts() {
                try {
                    const {data} = await axios.get(`/api/products`)
                    return data
                }catch (e) {
                    console.log('server error')
                }
            },
            updateCart() {
                this.$emit('updateCart')
            }
        }
    }
</script>

<style scoped>

</style>
