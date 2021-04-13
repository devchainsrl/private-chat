<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages="messages"/>
                    <input-message :room="currentRoom" @messageSent="getMessages()"></input-message>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import MessageContainer from "@/Pages/Chat/MessageContainer";
import InputMessage from "@/Pages/Chat/InputMessage";

export default {
    components: {
        InputMessage,
        MessageContainer,
        AppLayout,
    },
    data: function () {
        return {
            chatRooms: [],
            currentRoom: [],
            messages: [],
        }
    },
    methods: {
        getRooms() {
            axios.get('/chat/rooms').then(response => {
                this.chatRooms = response.data
                this.setRoom(response.data[0])
            }).catch(error => {
                console.log('error')
            })
        },
        getMessages() {
            axios.get('/chat/room/' + this.currentRoom.id + '/messages').then(response => {
                this.messages = response.data
            }).catch(error => {
                console.log('error')
            })
        },
        setRoom(room) {
            console.log('room set: ' + room.id)
            this.currentRoom = room;
            this.getMessages()
        }
    },
    created() {
        this.getRooms();
    }
}
</script>
