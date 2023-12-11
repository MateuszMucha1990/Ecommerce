<template>
    <div class="w-[200px] transition-all bg-blue-700 text-gray-200 p-4 px-2 rounded-l-xl">
            <router-link :to="{name:'app.dashboard'}" class="flex items-center hover:bg-black/30 py-1 px-3 rounded transition-colors mb-2">
                <span class="mr-2 text-gray-300">
                    <HomeIcon class="w-5"/>
                 </span>
                <span class="text-sm font-light">
                    Dashboard
                </span>
            </router-link>


            <router-link :to="{name:'app.products'}" class="flex items-center hover:bg-black/30 py-1 px-3 rounded transition-colors mb-2">
                <span class="mr-2 text-gray-300">
                    <ViewListIcon  class="w-5"/>
                 </span>
                <span class="text-sm font-light">
                    Products
                </span>
            </router-link>

            <router-link :to="{name:'app.products'}" class="flex items-center hover:bg-black/30 py-1 px-3 rounded transition-colors mb-2">
                <span class="mr-2 text-gray-300">
                    <UsersIcon   class="w-5"/>
                 </span>
                <span class="text-sm font-light">
                    Users
                </span>
            </router-link>

            <router-link :to="{name:'app.dashboard'}" class="flex items-center hover:bg-black/30 py-1 px-3 rounded transition-colors mb-2">
                <span class="mr-2 text-gray-300">
                    <ChartBarIcon  class="w-5"/>
                 </span>
                <span class="text-sm font-light">
                    Reports
                </span>
            </router-link>






        </div>
</template>

<script setup>
import {HomeIcon,UsersIcon,ChartBarIcon,ViewListIcon  } from '@heroicons/vue/outline'


</script>
