<template>
    <div class="main-container">
        <AdminNavBar />
        <UsernameViewComponent />
    </div>
</template>

<script>
import AdminNavBar from './AdminNavBar';
import UsernameViewComponent from './UsernameViewComponent.vue';

export default {
    components: {
        'AdminNavBar': AdminNavBar,
        'UsernameViewComponent': UsernameViewComponent
    }
}
</script>

<style scoped>
    .main-container {
        display: flex;
        flex-flow: column;
        height: 100%;
    }
</style>