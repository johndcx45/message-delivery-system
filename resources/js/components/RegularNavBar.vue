<template>
  <div class="nav-bar-component">
      <LogoutButton />
        <div class="header">
            <div class="h1-img-header">
                <img :src="'/img/time-machine.svg'" class="time-machine-icon">
                <h1 class="admin-header">Time Machine Application</h1>
            </div>
            <div class="nav-bar-regular">
                <nav class="nav-regular">
                    <ul class="ul-regular">
                        <li><router-link to="/regular" style="text-decoration: none; color: #000;">Home</router-link></li>
                        <li><router-link to="/reginbox" style="text-decoration: none; color: #000;">Inbox</router-link></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import LogoutButton from './LogoutButton.vue';
export default {
  components: { 'LogoutButton': LogoutButton }
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

    .header {
        text-align: center;
        display: block;
        margin: auto 0;
    } 

    .nav-bar-regular{
        width: 100%;
        text-align: center;
        margin-top: 10px;
    }

    .ul-regular {
        list-style: none;
    }

    .ul-regular li {
        display: inline-block;
        font-weight: 300;
        margin: 0 8px;
        font-size: 20px;
        border-bottom: 2px solid transparent;
        padding: 3px;
    }

    .ul-regular li:hover {
        transition: 0.2s;
        border-bottom: 2px solid #e40017;
    }

    nav ul li {
        text-decoration: none;
        color: #000;
    }
</style>