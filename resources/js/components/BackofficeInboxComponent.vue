<template>
    <div class="inbox-component">
        <BackofficeNavBar />
        <h3>Backoffice Inbox</h3>
        <div class="messages-container">
            <table>
                <thead>
                    <tr>
                        <th>Created By</th>
                        <th>Start Date</th>
                        <th>Expiration Date</th>
                        <th>Subject</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="message in messages" :key="message.id">
                        <td>{{ message.id }}</td>
                        <td>{{ message.start_date }}</td>
                        <td>{{ message.expiration_date }}</td>
                        <td>{{ message.subject }}</td>
                        <td>{{ message.content }}</td>                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import BackofficeNavBar from './BackofficeNavBar.vue'

export default {
  components: { 
      'BackofficeNavBar': BackofficeNavBar 
    },
    data() {
        return {
            messages: []
        }
    },
    created () {
        let user_id = localStorage.getItem('user_id');
        let access_token = localStorage.getItem('access_token');
        let url = `http://localhost:8000/api/message/user/${user_id}`;


        const fetchedData = this.axios.get( url, { headers: {
            "Access-Control-Allow-Origin" : "*",
            "Content-type": "Application/json",
            "Authorization": `Bearer ${access_token}`
            }
        }).then(response => {
            console.log(response);
            this.messages = response.data.messages;
        });
    },
}
</script>

<style scoped>
    h3 {
        display: block;    
        text-align: center;
        margin-top: 45px;
    }

    .messages-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
</style>