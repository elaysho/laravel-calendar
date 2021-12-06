<template>
    <div class="bg-base-200 space-y-4">
        <div class="block pt-3 px-3">
            <div class="navbar mb-2 shadow-lg bg-base-300 text-base-content rounded-box">
                <div class="flex-none"></div> 
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