<template>
    <div class="main-container">
        <AdminNavBar />
        <Homepage />
    </div>
</template>

<script>
import AdminNavBar from './AdminNavBar';
import HomepageComponent from './HomepageComponent';

export default {
    components: {
        'AdminNavBar': AdminNavBar,
        'Homepage': HomepageComponent
    }
}
</script>

<style>
    .main-container {
        display: flex;
        flex-flow: column;
        height: 100%;
        background-color: #f4f4f2;
    }
</style>