<template>
  <div class="nav-bar-component">
        <div class="header">
            <div class="h1-img-header">
                <img :src="'/img/time-machine.svg'" class="time-machine-icon">
                <h1 class="admin-header">Time Machine Application</h1>
            </div>
            <div class="nav-bar-regular">
                <nav class="nav-regular">
                    <ul class="ul-regular">
                        <li><router-link to="/regular">Home</router-link></li>
                        <li><router-link to="/reginbox">Inbox</router-link></li>
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

</style>