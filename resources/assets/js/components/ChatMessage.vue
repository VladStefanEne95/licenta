<template lang="html">
  <div class="chat-message">
    <div v-if="currentUser == message.user.name" class="user-left">
        <div class="img-with-text">
            <img style="width:40px; height:40px;" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png"/>
        </div>
        <div class="main-chat-text">
            <small>{{ message.user.name }}</small>
            <p>{{ message.message }}</p>
        </div>
    </div>
    <div v-else class="user-right">
        <div class="main-chat-text">
            <small>{{ message.user.name }}</small>
            <p>{{ message.message }}</p>
        </div>
        <div class="img-with-text">
            <img style="width:40px; height:40px;" src="http://www.clker.com/cliparts/B/R/Y/m/P/e/blank-profile-md.png"/>
        </div>
    </div>
  </div>
</template>

<script>
export default {
    props: {message:Object, currentUser:String}
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