<template>
    <div class="grid grid-cols-7 gap-x-2">
        <div class="col-span-1 flex-initial gap-y-2">
            <calendar-date :date="date" :day="value.day"></calendar-date>
        </div>
        <div class="col-span-6 flex-grow grid sml:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 pb-1 gap-2">
            <calendar-event v-for="(title, eventDate, j) in events" :title="title" :key="j"></calendar-event>
        </div>
    </div>
</template>

<script>
    import CalenderEvent from './CalendarEvent.vue';
    import CalendarDate from './CalendarDate.vue';

    export default {
        data() {
            return {}
        },
        components: { CalenderEvent, CalendarDate },
        props: ['date', 'value', 'eventsPerDate'],
        computed: {
            events() {
                return (this.eventsPerDate == undefined) ? [] : this.eventsPerDate;
            }
        }
    }
</script>