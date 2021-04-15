<template>
    <button class="btn-logout" @click.prevent="logout">Logout</button>
</template>

<script>
import axios from 'axios';
export default {
   methods: {
        logout() {
            let url = `http://localhost:8000/api/logout`;
            let access_token = localStorage.getItem('access_token');
            const fetchedData = this.axios.get( url, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
            }
            }).catch( error => {
                this.$alert(error);
            }).finally(() => {
                localStorage.removeItem('access_token');
                console.log(localStorage.getItem('access_token'));
                localStorage.removeItem('role');
                this.$router.push({ name: 'login', query: { redirect: 'login' }});
            });
        }
    }
}
</script>

<style>
    .btn-logout {
        position: absolute;
        top: 7px;
        right: 7px;
        float: right;
        border: 0px solid transparent;
        outline: none;
        background-color: transparent;
        border-bottom: 1px solid #0061a8;
        border-radius: 2px;
    }
</style>