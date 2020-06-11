<template>
    <div>
        <div v-if="globalVar" id="mute"></div>
        <reply v-for="reply in replies" v-bind:reply="reply" v-bind:key="reply.id" :author="author" count="5"></reply>
    </div>
</template>

<script>
    export default {
        name: "Comments",
        data: function () {
            return {
            }
        },
        props: {
            replies: Array,
            author: String,
        },
    }
</script>

<style scoped>
    #mute{
        position: absolute;
        opacity: 0.7;
        background-color: white;
        z-index: 100;
        height: 100%;
        width: 100%;
    }
</style>
