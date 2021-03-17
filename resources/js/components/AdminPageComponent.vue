<template>
    <div class="main-container">
        <div class="header">
            <div class="h1-img-header">
                <img :src="'/img/time-machine.svg'" class="time-machine-icon">
                <h1 class="admin-header">Time Machine Application</h1>
            </div>
            <div class="nav-bar-admin">
                <nav class="nav-admin">
                    <ul class="ul-admin">
                        <li>Home</li>
                        <li>Announcements</li>
                        <li>Create Announcement</li>
                        <li>Edit Announcement</li>
                        <li>Register User</li>
                    </ul>
                </nav>
            </div>
        </div>
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
        border-bottom: 2px solid #2196F3;
        padding: 3px;
    }

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
    }
</style>