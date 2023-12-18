<template>
    <div v-if="currentUser.id" class="flex min-h-full bg-gray-300">

        <!-- sidebar -->
       <Sidebar :class="{'-ml-[200px]': ! sidebarOpened}"/>
        <!--/ sidebar -->


        <div class="flex-1">
           <Navbar @toggle-sidebar="toggleSidebar" />

            <!-- Content -->
            <main class="p-6">
                <div class="p-4 rounded bg-white">
                    <router-view ></router-view>
                </div>
            </main>


            <!-- /Content -->
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import Sidebar  from '../components/Sidebar.vue'
import Navbar from './Navbar.vue';
import store from '../store';

const {title} =defineProps({
    title:String
})

const sidebarOpened=ref(true);
const currentUser = computed(()=> store.state.user.data);

function toggleSidebar(){
    sidebarOpened.value = !sidebarOpened.value;
}


//Hooks
onMounted(()=>{
    store.dispatch('getUser');

    handleSidebarOpened();
    window.addEventListener('resize',handleSidebarOpened)
});

onUnmounted(() => {
    window.removeEventListener('resize',handleSidebarOpened)
})

function handleSidebarOpened(){
    sidebarOpened.value =window.outerWidth > 768;   //jesli > od 768 to true, jesli nie to false
}




</script>

<style scoped></style>
