
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
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('comment-log', require('./components/CommentLog.vue'));
Vue.component('comment-message', require('./components/CommentMessage.vue'));
Vue.component('comment-composer', require('./components/CommentComposer.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));
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

            // Persist to the database etc
            axios.post('/messages', message).then(response => {
                // Do whatever;
            })
        },
        addComments(comment) {
            // Add to existing messages
            this.comments.push(comment);
            console.log(comment);
            // Persist to the database etc
        //    axios.post('/messages', message).then(response => {
                // Do whatever;
          //  })
        }
    },
    created() {
        axios.get('/messages').then(response => {
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
                    user: e.user
                });
            });
    }
});