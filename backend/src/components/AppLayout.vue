<template>
    <div class="flex min-h-full bg-gray-300">

        <!-- sidebar -->
       <Sidebar :class="{'-ml-[200px]': ! sidebarOpened}"/>
        <!--/ sidebar -->


        <div class="flex-1">
           <Navbar @toggle-sidebar="toggleSidebar" />

            <!-- Content -->
            <main class="p-6">
                <div class="p-4 rounded bg-white">
                    <router-view></router-view>
                </div>
            </main>


            <!-- /Content -->
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Sidebar  from '../components/Sidebar.vue'
import Navbar from './Navbar.vue';


const sidebarOpened=ref(true);

function toggleSidebar(){
    sidebarOpened.value = !sidebarOpened.value;
}


//Hooks
onMounted(()=>{
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
