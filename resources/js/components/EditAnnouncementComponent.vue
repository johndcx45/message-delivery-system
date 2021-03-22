<template>
  <div class="component-view">
        <AdminNavBar v-if="this.role == 'admin'"/>
        <BackofficeNavBar v-else-if="this.role == 'backoffice'"/>
        <h3>Edit Announcement</h3>
        <div class="content-view-create">
            <div class="input-container">
                <form class="create-form" method="POST" @submit.prevent="editMessage">
                    <label for="subject">Id</label>
                        <input type="text" class="input-text-create" id="input-id" name="id" v-model="id" placeholder="ID of the message" required>
                    <label for="subject">Subject</label>
                        <input type="text" class="input-text-create" id="input-subject" name="subject" v-model="subject" placeholder="Subject" required>
                    <label for="content">Content</label>
                        <input type="text" class="input-text-create" id="input-content" name="content" v-model="content" placeholder="Content" required>
                    <label for="startDate">Start Date</label>
                        <input type="text" class="input-text-create" id="input-start-date" name="startDate" v-model="startDate" placeholder="Start Date" required>
                    <label for="expirationDate">Expiration Date</label>
                        <input type="text" class="input-text-create" id="input-expiration-date" name="expirationDate" v-model="expirationDate" placeholder="Expiration Date" required>
                    <button class="btn-create">Edit</button>
                </form>
            </div>
        </div>
    </div>  
</template>

<script>
import AdminNavBar from './AdminNavBar';
import BackofficeNavBar from './BackofficeNavBar';
export default {
    components: {
        'AdminNavBar': AdminNavBar,
        'BackofficeNavBar': BackofficeNavBar
    },
    data () {
        return {
            id: null,
            subject: null,
            content: null,
            startDate: null,
            expirationDate: null,
            role: localStorage.getItem('role')
        }
    },
    methods: {
        editMessage () {
            var app = this;
            let access_token = localStorage.getItem('access_token');

            let id = app.id;
            let user = localStorage.getItem('name');
            let subject = app.subject;
            let content = app.content;
            let startDate = app.startDate;
            let expirationDate = app.expirationDate;
            let viewed_by = 'Clarice';

            let url = `http://localhost:8000/api/message/${id}`;

            const config = {
                headers: { Authorization: `Bearer ${access_token}`}
            }
            let err = null;

            let response = axios.put(url, {
                subject: subject,
                content: content,
                start_date: startDate,
                expiration_date: expirationDate,
                viewed_by: viewed_by,
                name: user
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
                    this.$alert('The message has been updated!');
                }
            });

            
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
        border-bottom: 2px solid #2196F3;
        padding: 5px;
        margin: 7px 10px;
    }

    .btn-create {
        border: 0px solid transparent;
        outline: none;
        background-color: #2196F3;
        width: 100px;
        height: 35px;
        color: white;
        float: right;
        border-radius: 3px;
    }
</style>