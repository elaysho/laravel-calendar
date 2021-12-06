<template>
    <div class="text-justify p-1">
        <span class="font-sans font-semibold text-3xl text-base-content">{{ date }}</span>
        <span class="font-sans font-semibold text-lg text-base-content">{{ lowerCasedDay }}</span>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        props: ['date', 'day'],
        computed: {
            lowerCasedDay() {
                return this.day.toLowerCase();
            }
        }
    }
</script>