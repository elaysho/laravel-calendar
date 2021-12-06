<template>
    <div class="w-full h-full flex flex-col p-3 gap-2">
        <div class="flex flex-row space-x-2 justify-content-between align-items-center">
            <button class="btn btn-outline btn-square sm:btn-md lg:btn-md" @click="changeMonth(false, true)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                    <path d="M21 24l-18-12 18-12v24zm-16.197-12l15.197 10.132v-20.263l-15.197 10.131"/>
                </svg>
            </button> 

            <label class="font-sans font-semibold text-5xl sm:text-7xl lg:text-8xl text-base-content"> 
                {{ currentMonth }} {{ currentYear }}
            </label>

            <button class="btn btn-outline btn-square sm:btn-md lg:btn-md" @click="changeMonth(true, false)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                    <path d="M3 24l18-12-18-12v24zm16.197-12l-15.197 10.132v-20.263l15.197 10.131"/>
                </svg>
            </button> 
        </div>
        <div class="bg-base-100 w-full shadow rounded-box p-4 gap-y-2">
            <div class="grid grid-rows-7 gap-1">
                <calendar-cell v-for="(value, date, i) in daysOfMonth" 
                    :date="date" 
                    :value="value" 
                    :eventsPerDate="eventsPerDate[value.date]"
                    :key="i">
                </calendar-cell>
            </div>
        </div>
    </div>
</template>

<script>
    import CalendarCell from './CalendarCell.vue';

    export default {
        mounted() {
            console.log('CalendarContainer component mounted.');
        },
        data() {
            return {
                currentMonth: '',
                currentYear: '',
                daysOfMonth: [],
            }
        },
        components: { CalendarCell },
        props: ['eventsPerDate'],
        created() {
            this.axios
                .get(this.baseURL + '/api/calendar')
                .then(response => {
                    this.currentMonth = response.data.month;
                    this.daysOfMonth  = response.data.dates;
                    this.currentYear  = response.data.year;
                });

            console.log(this.eventsPerDate);
        },
        methods: {
            changeMonth(next, prev) {
                let getCalendarDates = `/api/calendar?month=${this.currentMonth}&year=${this.currentYear}
                                            &next=${next}&prev=${prev}`;
                this.axios
                    .get(this.baseURL + getCalendarDates)
                    .then(response => {
                        this.currentMonth = response.data.month;
                        this.daysOfMonth  = response.data.dates;
                        this.currentYear  = response.data.year;
                    });

                this.axios
                    .get(this.baseURL + '/api/v1/events')
                    .then(response => {
                        if(response.status == 200) {
                            this.$emit('setEvents', response.data.events);
                        }
                    });
            },
        },
    }
</script>
