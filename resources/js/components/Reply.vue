<template>
    <div class="card ml-2 my-1">
        <div class="card-body">
            <p><strong>{{reply.title}}</strong></p>
            <p class="card-subtitle mb-2 text-muted">author:{{reply.author}}</p>
            <p>{{reply.text}}</p>

            <div class="d-flex justify-content-between">
                <button v-if="!load && !reply.no_replies" class="btn btn-primary mb-2" @click="loading(reply.id,3)">see
                    replies
                </button>
                <button v-if="load && !reply.no_replies" class="btn btn-primary mb-2" @click="load =!load">hide
                    replies
                </button>

                <button v-if="author" class="btn btn-primary mb-2" type="button" data-toggle="collapse"
                        v-bind:data-target="'#writeComment' + reply.id" aria-expanded="false"
                        v-bind:aria-controls="'writeComment'+reply.id">
                    Reply
                </button>
            </div>
            <div v-if="author" v-bind:class="collapse" v-bind:id="'writeComment' + reply.id">
                <form v-on:submit.prevent>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input v-model="title" type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="text">Comment</label>
                        <textarea v-model="text" class="form-control" name="text" id="text" rows="4"></textarea>
                    </div>
                    <button @click="sendReply(reply.id)" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>

        </div>
        <div v-if="load">
            <reply v-for="reply in replies" v-bind:reply="reply" v-bind:key="reply.id" :author="author"
                   :count="count-1"></reply>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Reply",
        props: ['reply', 'author', 'count'],
        data: function () {
            return {
                'load': false,
                'replies': [],
                'title': null,
                'text': null,
                'collapse': 'collapse'
            }
        },
        methods: {
            loading: function (id, amount) {
                axios.get('/api/replies/' + id).then(response => {
                    this.replies = response.data;
                    this.load = true;
                    this.count = amount;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            sendReply: function (id) {
                axios.post('/api/replies/' + id + '/reply', {
                    title: this.title,
                    text: this.text,
                    author: this.author,
                }).then(response => {
                    this.title = null;
                    this.text = null;
                    this.loading(id, 1);
                }).catch(function (error) {
                    console.log(error);
                })
            }
        },
        mounted: function () {
            if (this.count > 0) {
                axios.get('/api/replies/' + this.reply.id).then(response => {
                    this.replies = response.data;
                    this.load = true;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
    }
</script>

<style scoped>

</style>
