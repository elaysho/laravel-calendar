<template>
    <div v-if="validationErrors">
        <span v-for="(value, key, index) in validationErrors" class="text-error ml-2" :key="index">
            {{ value }}
        </span>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        props: ['errors'],
        computed: {
            validationErrors(){
                let errors = Object.values(this.errors);
                errors = errors.flat().map(err => err.toLowerCase());

                return errors;
            }
        }
    }
</script>