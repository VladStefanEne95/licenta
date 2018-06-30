<template lang="html">
  <div v-if="currentUser == message.user.name || otherUser == message.user_recv_id" class="chat-message">
    <div v-if="currentUser == message.user.name" class="user-right">
        <div class="main-chat-text">
            <p class="message-right">{{ message.message }}</p>
        </div>
        <div class="img-with-text">
            <img style="width:40px; height:40px;" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png"/>
            <br><small>{{ message.user.name }}</small>
        </div>
    </div>
    <div v-else-if="otherUser == message.user_recv_id" class="user-left">
        <div class="img-with-text">
            <img style="width:40px; height:40px;" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png"/>
             <br><small>{{ message.user.name }}</small>
        </div>
        <div class="main-chat-text">
            <p class="message-left">{{ message.message }}</p>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    props: {message:Object, currentUser:String, otherUser:String}
}
</script>

<style lang="css">
.chat-message {
    padding: 1rem;
}
.chat-message > p {
    margin-bottom: .5rem;
}
</style> 

