<template>
    <div class="component-view">
        <AdminNavBar />
        <h3>Create Announcement</h3>
        <div class="content-view-create">
            <div class="input-container">
                <form class="create-form" method="POST" @submit.prevent="createMessage">
                    <label for="subject">Subject</label>
                        <input type="text" class="input-text-create" id="input-subject" name="subject" v-model="subject" placeholder="Subject" required>
                    <label for="subject">Content</label>
                        <input type="text" class="input-text-create" id="input-content" name="content" v-model="content" placeholder="Content" required>
                    <label>Start Date</label>
                        <input type="text" class="input-text-create" id="input-start-date" name="startDate" v-model="startDate" placeholder="Start Date" required>
                    <label>Expiration Date</label>
                        <input type="text" class="input-text-create" id="input-expiration-date" name="expirationDate" v-model="expirationDate" placeholder="Expiration Date" required>
                    <button class="btn-create">Create</button>
                </form>
            </div>
        </div>
    </div>  
</template>

<script>
import AdminNavBar from './AdminNavBar';
import  VueSimpleAlert from 'vue-simple-alert';
import Vue from 'vue';

Vue.use(VueSimpleAlert);

export default {
    components: {
        'AdminNavBar': AdminNavBar
    },
    data () {
        return {
            subject: null,
            content: null,
            startDate: null,
            expirationDate: null
        }
    },
    methods: {
        createMessage () {
            var app = this;
            let access_token = localStorage.getItem('access_token');

            const config = {
                headers: { Authorization: `Bearer ${access_token}`}
            }

            let subject = app.subject;
            let content = app.content;
            let startDate = app.startDate;
            let expirationDate = app.expirationDate;

            let url = 'http://localhost:8000/api/message'

            let err = null;

            let response = axios.post(url, {
                subject: subject,
                content: content,
                start_date: startDate,
                expiration_date: expirationDate
            }, config
            ).then(response => {
                console.log(response);
            }).catch(err => {
                if(err){
                    err = null;
                    this.$alert('An unexpected error ocurred!');
                }
            }).finally(() => {
                if ( !err ) {
                    this.$alert('The message has been created!');
                }
            })
        }
    }
}
</script>

<style>

    label {
        text-align: left;
    }

    .input-text-create {
        display: block;
        margin: 8px 0px;
        padding: 3px;
        border: 0 solid transparent;    
        border-bottom: 2px solid #009879;
        border-radius: 2px;
    }

</style>