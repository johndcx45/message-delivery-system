<template>
    <div class="nav-bar-component">
        <LogoutButton />
        <div class="header">
            <div class="h1-img-header">
                <img :src="'/img/time-machine.svg'" class="time-machine-icon">
                <h1 class="admin-header">Time Machine Application</h1>
            </div>
            <div class="nav-bar-admin">
                <nav class="nav-admin">
                    <ul class="ul-admin">
                        <li><router-link to="/admin" style="text-decoration: none; color: #000;">Home</router-link></li>
                        <li><router-link to="/view" style="text-decoration: none; color: #000;">Announcements</router-link></li>
                        <li><router-link to="/create" style="text-decoration: none; color: #000;">Create Announcement</router-link></li>
                        <li><router-link to="/register" style="text-decoration: none; color: #000;">Register User</router-link></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import LogoutButton from './LogoutButton.vue'
export default {
  components: { 'LogoutButton': LogoutButton },
 
}
</script>

<style>

    .nav-bar-component {
        background-color: #fff;
    }

    .h1-img-header {
        display: flex;
        flex-direction: row;
        align-content: center;
        justify-content: center;
    }
  
     .time-machine-icon {
        width: 75px;
        height: 75px;
        display: block;
    }  

    .admin-header {
        text-align: center;
        display: block;
        margin: auto 0;
    } 

    .nav-bar-admin {
        width: 100%;
        text-align: center;
        margin-top: 10px;
    }

    .ul-admin {
        list-style: none;
    }

    .ul-admin li {
        display: inline-block;
        font-weight: 300;
        margin: 0 8px;
        font-size: 20px;
        border-bottom: 2px solid transparent;
        padding: 3px;
    }

    .ul-admin li:hover {
        transition: 0.2s;
        border-bottom: 2px solid #e40017;
    }

    nav ul li {
        text-decoration: none;
        color: #000;
    }
</style>