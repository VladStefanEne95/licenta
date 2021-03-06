
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('example', require('./components/Example.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-message2', require('./components/ChatMessage2.vue'));
Vue.component('chat-log2', require('./components/ChatLog2.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));
Vue.component('chat-composer2', require('./components/ChatComposer2.vue'));
const app = new Vue({
    el: '#app',
    data: {
        messages: [],
        usersInRoom: [],
        comments: []
    },
    methods: {
        addMessage(message) {
            // Add to existing messages
            this.messages.push(message);
            let url;
            if(window.location.href.indexOf('projects') > -1) {
                url = '/msgProjects/' + (window.location.href).split("/").pop();    
            } else {
                url = '/messages/' + (window.location.href).split("/").pop();
            }
            // Persist to the database etc
            axios.post(url, message).then(response => {
                
            })
        }
    }, 
    created() {
        let url;
            if(window.location.href.indexOf('projects') > -1) {
                url = '/msgProjects/' + (window.location.href).split("/").pop();    
            } else {
                url = '/messages/' + (window.location.href).split("/").pop();
            }
        axios.get(url).then(response => {
            this.messages = response.data;
        });

        window.Echo.join('chatroom')
            .here((users) => {
                this.usersInRoom = users;
            })
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user)
            })
            .listen('MessagePosted', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user_recv_id: e.message.user_recv_id,
                    user_id: e.message.user_id,
                    user: e.user,
                    project: e.message.project
                });
                msg = 1;
            });
    }
});
