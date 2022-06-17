<template>
    <div class="p-5">
        <h1 class="text-2xl mb-4">Laravel Video Chat</h1>
        <div class="grid grid-flow-row grid-cols-3 grid-rows-3 gap-4 bg-black/]">
            <div id="my-video-chat-window"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'video-chat',
    data() {
        return {
            accessToken: ''
        }
    },
    methods : {
        getAccessToken : function () {
            const vm = this
            // Request a new token
            this.$axios.get('/access_token')
                .then(function (response) {
                    vm.connectToRoom(response.data);
                })
                .catch(function (error) {
                    console.error(error);
                })
        },
        connectToRoom : function ($accessToken) {
            const { connect, createLocalVideoTrack } = require('twilio-video');

            connect( $accessToken, { name:'cool room' }).then(room => {
                
                console.log(`Successfully joined a Room: ${room}`);

                const videoChatWindow = document.getElementById('my-video-chat-window');

                createLocalVideoTrack().then(track => {
                    videoChatWindow.appendChild(track.attach());
                });

                room.on('participantConnected', participant => {
                    console.log(`Participant "${participant.identity}" connected`);

                    participant.tracks.forEach(publication => {
                        if (publication.isSubscribed) {
                            const track = publication.track;
                            videoChatWindow.appendChild(track.attach());
                        }
                    });

                    participant.on('trackSubscribed', track => {
                        videoChatWindow.appendChild(track.attach());
                    });
                });
            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
            });
        }
    },
    mounted() {
        this.getAccessToken()
    }
}
</script>