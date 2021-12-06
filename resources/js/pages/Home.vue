<template>
    <div class="grid gap-3 sm:grid-cols-1 lg:grid-cols-3">
        <div class="col-span-1 pt-3 px-3">
            <div class="flex flex-col sm:flex-col md:flex-row-reverse space-x-0 md:space-x-2 lg:flex-col">
                <label class="font-sans font-semibold text-5xl sm:text-7xl sm:text-right lg:text-5xl lg:text-left text-base-content">
                    add an event 
                </label>

                <form @submit.prevent="addEvent()">
                    <div class="bg-base-300 rounded-box shadow space-y-2 mt-3 p-3">
                        <input type="text" placeholder="Event Title" class="input input-bordered text-base-content w-full" v-model="product.title">
                        <form-error v-if="errors.title" :errors="errors.title"></form-error>

                        <div class="space-y-2">
                            <label class="font-sans font-semibold text-2xl text-base-content"> 
                                event period
                            </label>

                            <input type="date" placeholder="From" class="input input-bordered text-base-content w-full" v-model="product.from">
                            <form-error v-if="errors.from" :errors="errors.from"></form-error>

                            <input type="date" placeholder="To" class="input input-bordered text-base-content w-full" v-model="product.to">
                            <form-error v-if="errors.to" :errors="errors.to"></form-error>
                        </div>

                        <div class="space-y-2">
                            <label class="font-sans font-semibold text-2xl text-base-content"> 
                                every
                            </label>

                            <div class="flex flex-row flex-wrap gap-2">
                                <template v-for="(day, i) in daysOfWeek">
                                    <div class="flex gap-x-2 align-items-center" :key="i">
                                        <input type="checkbox" class="checkbox checkbox-md" :value="day" v-model="product.recurring_values">
                                        <span class="label-text">{{ day }}</span> 
                                    </div>
                                </template>
                            </div>
                            <form-error v-if="errors.recurring_values" :errors="errors.recurring_values"></form-error>

                        </div>
                        
                        <div class="flex flex-row-reverse">
                            <button type="submit" class="btn btn-primary" >Save</button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-span-2">
            <calendar-container :eventsPerDate="eventsPerDate"></calendar-container>
        </div>
    </div>
</template>

<script>
    import FormError from '../components/alerts/FormError.vue';
    import CalendarContainer from '../components/calendar/CalendarContainer.vue';

    export default {
        data() {
            return {
                daysOfWeek: [
                    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
                ],

                eventsPerDate: [],
                product: {
                    title: null,
                    from: null,
                    to: null,
                    recurring_values: [],
                },
                errors: [],
            }
        },
        components: { FormError, CalendarContainer },
        mounted() {
            console.log('Home component mounted.');
        },
        created() {
            this.getEvents();
        },
        methods: {
            getEvents() {
                this.axios
                    .get(this.baseURL + '/api/v1/events')
                    .then(response => {
                        if(response.status == 200) {
                            this.eventsPerDate = response.data.events;
                        }
                    });
            },
            setEvent(eventsPerDate) {
                this.eventsPerDate = eventsPerDate;
            },
            addEvent() {
                this.axios
                    .post(this.baseURL + '/api/v1/events', this.product)
                    .then(response => {
                        if(response.status == 200 ) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Event successfully added!'
                            });

                            this.eventsPerDate = response.data.events;
                            this.errors = [];
                        }
                    })
                    .catch(error => {
                        if(error.response.status == 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        },
    }
</script>