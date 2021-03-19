<template>
  <div class="component-view">
        <AdminNavBar />
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

export default {
    components: {
        'AdminNavBar': AdminNavBar
    },
    data () {
        return {
            id: null,
            subject: null,
            content: null,
            startDate: null,
            expirationDate: null
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

<style>

</style>