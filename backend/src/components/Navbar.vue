<template>
    <header class="h-16 shadow bg-white flex items-center justify-between">
        <button @click="emit('toggle-sidebar')" class="p-4 test-gray-700 hover:bg-black/10">
            <MenuIcon class="w-6" />
        </button>

        <div class="px-4">
            <Menu as="div" class="relative inline-block text-left">
                <div>
                    <MenuButton class="flex items-center ">
                        <img src="https://xsgames.co/randomusers/avatar.php?g=male" class="rounded-full w-8 mr-2">
                       <small>{{currentUser.name}}</small>
                        <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5 text-violet-200 hover:text-violet-100"
                            aria-hidden="true" />
                    </MenuButton>
                </div>

                <transition enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <MenuItems
                        class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                        <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                            <button :class="[
                                active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]">
                                 <UserIcon :active="active" class="mr-2 h-5 w-5 text-indigo-400"  aria-hidden="true" />
                                Profile
                            </button>
                            </MenuItem>


                            <MenuItem v-slot="{ active }">
                            <button :class="[
                                active ? 'bg-violet-500 text-white' : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]"
                                @click="logout">
                                <LogoutIcon :active="active" class="mr-2 h-5 w-5 text-indigo-400"  aria-hidden="true" />
                                Logout
                            </button>
                            </MenuItem>
                        </div>

                    </MenuItems>
                </transition>
            </Menu>
        </div>
    </header>
</template>

<script setup>

import { MenuIcon } from '@heroicons/vue/outline'
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon,LogoutIcon,UserIcon } from '@heroicons/vue/solid'
import store from '../store';
import router from '../router';
import { computed } from 'vue';



const emit = defineEmits(['toggle-sidebar']);

const currentUser = computed(()=> store.state.user.data);

function logout(){
    store.dispatch('logout')
        .then(()=>{
            router.push({name:'login'})
        })
}


</script>

