<template>
    <div class="component-homepage">
        <div class="main-content">
            <h1>Welcome {{ getUsername() }}</h1>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        getUsername () {
            return localStorage.getItem('name');
        }
    },
}
</script>

<style>
    .main-content {
        margin-top: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 111px;
        bottom: 0;
        width: 100%;
        background-color: #e8e8e8;
        border-top: 2px solid #000;
        border-radius: 5px;
    }
</style>