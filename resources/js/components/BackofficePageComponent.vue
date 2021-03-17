<template>
    <div class="main-container">
        <img :src="'/img/time-machine.svg'" class="time-machine-icon">
        <h1>Time Machine Application</h1>
        <div class="nav-bar">
            <nav>
                <ul>
                    <li>Home</li>
                    <li>Announcements</li>
                    <li>Create Announcement</li>
                    <li>Edit Announcement</li>
                </ul>
            </nav>
        </div>
        <div class="content">

        </div>
    </div>
</template>

<script>
export default {

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