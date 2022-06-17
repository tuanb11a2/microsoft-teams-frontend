<template>
    <div>
        <input type="text" v-model="message.room_id"/>
    <input type="text" v-model="message.user_id"/>
    <input type="text" v-model="message.content"/>
    </div>
</template>

<script>

export default {
    data(){
        return {
            message: {
                room_id: '',
                user_id: '',
                content: ''
                
            },
            messsages: []
        }
    },
    mounted(){
        this.$echo.private(`room.1}`)
          .listen('MessageSent', (e) => {
              this.messages.push(e.message)
              console.log(e)
          })
    }
    
}
</script>