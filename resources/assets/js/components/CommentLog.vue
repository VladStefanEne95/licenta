<template lang="html">
  <div class="chat-log">
      <comment-message v-for="comment in comments" :key="comment.id" :comment="comment"></comment-message>
      <div class="empty" v-show="comment.length === 0">
          Nothing here yet!
      </div>
  </div>
</template>

<script>
export default {
    props: ['comment']
}
</script>

<style lang="css">
.chat-log .chat-message:nth-child(even) {
    background-color: #ccc;
}
.empty {
    padding: 1rem;
    text-align: center;
}
</style>