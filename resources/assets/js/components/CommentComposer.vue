<template lang="html">
  <div class="chat-composer">
      <input type="text" placeholder="Start typing your message..." v-model="commentText" @keyup.enter="sendComment">
      <button class="btn btn-primary" @click="sendComment">Send</button>
  </div>
</template>

<script>
export default {
    props: ['currentUser'],
    data() {
        return {
            commentText: ''
        }
    },
    methods: {
        sendComment() {
            this.$emit('commentsent', {
                comment: this.commentText,
                user: {
                    name: this.currentUser
                }
            });
            this.commentText = '';
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