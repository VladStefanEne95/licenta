<template lang="html">
  <div class="chat-composer">
      <input type="text" id="chatInput" placeholder="Start typing your message..." v-model="messageText" @keyup.enter="sendMessage">
      <button id="sendMessage" class="btn btn-primary" @click="sendMessage">Send</button>
  </div>
</template>

<script>
export default {
    props: ['currentUser'],
    data() {
        return {
            messageText: ''
        }
    },
    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                message: this.messageText,
                user: {
                    name: this.currentUser
                }
            });
            this.messageText = '';
            msg = 1;
        }
    }
}
</script>

<style lang="css">
.chat-composer {
    display: flex;
}
.chat-composer input {
    flex: 1 auto;
    padding: .5rem 1rem;
}
.chat-composer button {
    border-radius: 0;
}
</style>