<template lang="html">
  <div class="chat-message">
    <p>{{ comment.comment }}</p>
    <small>{{ comment.user.name }}</small>
  </div>
</template>

<script>
export default {
    props: ['comment']
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