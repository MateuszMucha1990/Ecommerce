<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-3xl font-semibold">Products</h1>
        <button type="submit"
            class="flex justify-center py-2 px-4 border border-transparent test-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-400">
            Add new product
        </button>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between border-b-2 pb-3">
            <div class="flex items-center">
                <span class="whitespace-nowrap mr-3">Per page</span>
                <select  @change="getProducts(null)" v-model="perPage"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">

                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div>
                <input  @change="getProducts(null)" v-model="search"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Type to Search products">
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <TableHeaderCell field="id" class="boarder-b-2 p-2 text-left" :sort-field="sortField" :sort-direction="sortDirection" @click="sortProduct('id')">
                        ID
                    </TableHeaderCell>
                    <TableHeaderCell field="image" class="boarder-b-2 p-2 text-left" :sort-field="sortField" :sort-direction="sortDirection" @click="sortProduct">
                        Image
                    </TableHeaderCell>
                    <TableHeaderCell field="title" class="boarder-b-2 p-2 text-left" :sort-field="sortField" :sort-direction="sortDirection" @click="sortProduct">
                        Title
                    </TableHeaderCell>
                    <TableHeaderCell field="price" class="boarder-b-2 p-2 text-left" :sort-field="sortField" :sort-direction="sortDirection" @click="sortProduct">
                        Price
                    </TableHeaderCell>
                    <TableHeaderCell field="updated_at" class="boarder-b-2 p-2 text-left" :sort-field="sortField" :sort-direction="sortDirection" @click="sortProduct">
                        Last Updated At
                    </TableHeaderCell>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(product, index) of product.data">

                    <td class="border-b p-2 ">{{ product.id }}</td>
                    <td class="border-b p-2 ">
                        <img class="w-16 h-16 object-cover " :src="product.image_url" :alt="product.title">
                    </td>
                    <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">
                        {{ product.title }}
                    </td>
                    <td class="border-b p-2 ">
                        <p class="flex justify-center"> {{ product.price }}</p>
                    </td>
                    <td class="border-b p-2 ">
                        {{ product.updated_at }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-between items-center mt-5">
            <span>
                Showing from {{ product.from }} to {{ product.to }}
            </span>

            <nav v-if="product.total > product.limit"

                class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                <a v-for="(link, i) of product.links" :key="i" :disabled="!link.url" href="#"
                    @click="getForPage($event, link)" aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap" :class="[
                        link.active
                            ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                        i === 0 ? 'rounded-l-md' : '',
                        i === product.links.length - 1 ? 'rounded-r-md' : '',
                        !link.url ? ' bg-gray-100 text-gray-700' : ''
                    ]" v-html="link.label">
                </a>
            </nav>
        </div>



    </div>
</template>



<script setup>
import { computed, ref, onMounted } from 'vue';
import store from '../store';
import { PRODUCTS_PER_PAGE } from '../constants.js'
import TableHeaderCell from '../components/core/table/TableHeaderCell.vue';



const perPage = ref(PRODUCTS_PER_PAGE);
const search = ref('')
const product = computed(() => store.state.products)
const sortField = ref('updated_at')
const sortDirection = ref('desc')



//Hooks
onMounted(() => {
    getProducts();
})


function getProducts(url=null) {
    store.dispatch('getProducts',{
        url,
        sort_field:sortField.value,
        sort_direction:sortDirection.value,
        search:search.value,
        perPage:perPage.value
    })
}

function getForPage(ev,link){
    ev.preventDefault();
    if(!link.url || link.active){
       return ;
    }
    getProducts(link.url)
}

function sortProduct(field) {
  if (field === sortField.value) {
    if (sortDirection.value === 'desc') {
      sortDirection.value = 'asc'
    } else {
      sortDirection.value = 'desc'
    }
  } else {
    sortField.value = field;
    sortDirection.value = 'asc'
  }

  getProducts()
}

</script>
