<template>
    <transition class="v-enter">
        <div class="card text-center bg-accent-focus text-base-content">
            <div class="card-body justify-content-center align-items-center p-0">
                <p>{{ title }}</p> 
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        data() {
            return {}
        },
        props: ['title'],
    }
</script>