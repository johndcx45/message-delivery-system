<template>
    <div class="main-container">
        <BackofficeNavBar />
        <UsernameViewComponent />
    </div>
</template>

<script>
import BackofficeNavBar from './BackofficeNavBar.vue'
import UsernameViewComponent from './UsernameViewComponent.vue'
export default {
    components: {
        'BackofficeNavBar': BackofficeNavBar,
        'UsernameViewComponent': UsernameViewComponent
    }
}
</script>

<style>
    ul {
        list-style: none;
    }

    ul li {
        display: inline-block;
    }
</style>