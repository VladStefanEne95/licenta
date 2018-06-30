<template lang="html">
  <div id="chat-log" class="chat-log">
      <chat-message v-for="message in messages" :key="message.id" :otherUser="otherUser" :currentUser="currentUser" :message="message"></chat-message>
      <div class="empty" v-show="messages.length === 0">
          Nothing here yet!
      </div>
  </div>
</template>

<script>
export default {
    props: {messages:Array, currentUser:String, otherUser:String}
}
</script>

<style lang="css">
.chat-log .chat-message:nth-child(even) {
   /* background-color: #ccc;*/
}
.empty {
    padding: 1rem;
    text-align: center;
}
</style>