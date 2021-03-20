<template>
    <div class="nav-bar-component">
        <div class="header">
            <div class="h1-img-header">
                <img :src="'/img/time-machine.svg'" class="time-machine-icon">
                <h1 class="admin-header">Time Machine Application</h1>
            </div>
            <div class="nav-bar-admin">
                <nav class="nav-admin">
                    <ul class="ul-admin">
                        <li><router-link to="/admin">Home</router-link></li>
                        <li><router-link to="/view">Announcements</router-link></li>
                        <li><router-link to="/create">Create Announcement</router-link></li>
                        <li><router-link to="/edit">Edit Announcement</router-link></li>
                        <li><router-link to="/register">Register User</router-link></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
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
        border-bottom: 2px solid #2196F3;
    }

    nav ul li {
        text-decoration: none;
        color: #000;
    }
</style>