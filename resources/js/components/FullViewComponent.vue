<template>
    <div class="full-view-component">
        <AdminNavBar />
        <div class="message-fullview">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Created by</th>
                        <th>Subject</th>
                        <th>Content</th>
                        <th>Start Date</th>
                        <th>Expiration Date</th>
                        <th>Viewed By</th>
                        <th>Read By All</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                        <td>{{ message.id }}</td>
                        <td>{{ message.created-by }}</td>
                        <td>{{ message.subject }}</td>
                        <td>{{ message.content }}</td>
                        <td>{{ message.start_date }}</td>
                        <td>{{ message.expiration_date }}</td>
                        <td>{{ message.viewed_by }}</td>
                        <td>{{ message.read_by_all === 0 ? false : true}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import AdminNavBar from './AdminNavBar.vue'

export default {
    components: { 
        'AdminNavBar': AdminNavBar 
    },
    data () {
        return {
            message: []
        }
    },
    created () {
        let message_view_id = localStorage.getItem('message_view_id');

        let url = `http://localhost:8000/api/message/${message_view_id}`;

        let access_token = localStorage.getItem('access_token');

        const fetchedData = this.axios.get( url, { headers: {
            "Access-Control-Allow-Origin" : "*",
            "Content-type": "Application/json",
            "Authorization": `Bearer ${access_token}`
            }
        }).then(response => {
            this.message = response.data.message;
            console.log(response);
        });
    }
}
</script>

<style>

</style> 