<template>
    <div class="component-view">
        <AdminNavBar v-if="this.role == 'admin'"/>
        <BackofficeNavBar v-else-if="this.role == 'backoffice'"/>
        <RegularNavBar v-else/>
        <h3>Create Announcement</h3>
        <div class="content-view-create">
            <div class="input-container">
                <div class="ghost">
                </div>
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
import VueSimpleAlert from 'vue-simple-alert';
import Vue from 'vue';
import BackofficeNavBar from './BackofficeNavBar';
import RegularNavBar from './RegularNavBar.vue';

Vue.use(VueSimpleAlert);

export default {
    components: {
        'AdminNavBar': AdminNavBar,
        'BackofficeNavBar': BackofficeNavBar,
        'RegularNavBar': RegularNavBar
    },
    data () {
        return {
            subject: null,
            content: null,
            startDate: null,
            expirationDate: null,
            role: localStorage.getItem('role')
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

            let url = 'http://localhost:8000/api/message';

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

<style scoped>

    .content-view-create {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    h3 {
        display: block;    
        text-align: center;
        margin-top: 45px;
    }

    .input-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 3px 3px 5px 6px #eee;
        background-color: #fff;
        border-radius: 15px;
        width: 450px;
        height: 400px;
        margin-top: 100px;
    }

    .ghost {
        display: block;
        height: 40px;
    }

    label {
        text-align: left;
    }

    .input-text-create {
        display: block;
        margin: 8px 0px;
        border: 0 solid transparent;    
        border-bottom: 2px solid #f05454;
        padding: 5px;
        margin: 7px 10px;
    }

    .btn-create {
        border: 0px solid transparent;
        outline: none;
        background-color: #f05454;
        width: 100px;
        height: 35px;
        color: white;
        float: right;
        border-radius: 3px;
    }

</style>