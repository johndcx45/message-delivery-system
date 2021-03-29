<template>
    <div class="full-view-component">
        <RegularNavBar />
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
                        <td>{{ message.created_by }}</td>
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
import RegularNavBar from './RegularNavBar';

export default {
    components: { 
        'RegularNavBar': RegularNavBar
    },
    data () {
        return {
            message: []
        }
    },
    created () {
        this.markAsRead();
        let message_view_id = localStorage.getItem('message_view_id');

        let url = `http://localhost:8000/api/message/${message_view_id}`;

        let access_token = localStorage.getItem('access_token');

        const fetchedData = this.axios.get( url, { headers: {
            "Access-Control-Allow-Origin" : "*",
            "Content-type": "Application/json",
            "Authorization": `Bearer ${access_token}`
            }
        }).then(response => {
            this.message = response.data.message
        });
        
    },
    methods:{
         markAsRead() {
            let message_view_id = localStorage.getItem('message_view_id');

            let url = `http://localhost:8000/api/message/${message_view_id}`;

            let access_token = localStorage.getItem('access_token');

            const fetchedData = this.axios.get( url, { headers: {
                "Access-Control-Allow-Origin" : "*",
                "Content-type": "Application/json",
                "Authorization": `Bearer ${access_token}`
                }
            }).then(response => { 
                
                let id = localStorage.getItem('message_view_id');
                let name = localStorage.getItem('name');
                let message = response.data.message;
                 
                if(!message.viewed_by.includes(name) || message.viewed_by == '') { 
                    let url = `http://localhost:8000/api/read`;

                    let access_token = localStorage.getItem('access_token');
                    const config = { 
                        headers: { Authorization: `Bearer ${access_token}`}
                    }

                    let response = axios.post(url, {
                        id: id,
                        name: name
                    }, config
                    ); 
                }
            });
        },
        getMessage() {
            let message_view_id = localStorage.getItem('message_view_id');

            let url = `http://localhost:8000/api/message/${message_view_id}`;

            let access_token = localStorage.getItem('access_token');

            const fetchedData = this.axios.get( url, { headers: {
                    "Access-Control-Allow-Origin" : "*",
                    "Content-type": "Application/json",
                    "Authorization": `Bearer ${access_token}`
                }
            }).then(response => { 
                //console.log(response.data.message);
            });
        }
    }
}

</script>

<style>

</style> 