<template>
    <div class="bg-base-200 space-y-4">
        <div class="block pt-3 px-3">
            <div class="navbar mb-2 shadow-lg bg-base-300 text-base-content rounded-box">
                <div class="flex-none pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div> 
                <div class="flex-1 px-2 mx-2">
                    <span class="text-lg font-bold"> {{ title }} </span>
                </div>
            </div>
        </div>

        <div class="px-3">
            <router-view> </router-view>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('App component mounted.');
        },
        data() {
            return {
                title: process.env.APP_NAME ?? 'Laravel Calendar',
            }
        }
    }
</script>