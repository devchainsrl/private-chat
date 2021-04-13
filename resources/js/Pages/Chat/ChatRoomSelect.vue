<template>
    <div class="grid grid-cols-2">
        <div class="font-bold text-xl">
            {{ selectedRoom.name }}
        </div>
        <div>
            <select
                v-model="selectedRoom"
                @change="$emit('roomchanged', selectedRoom)"
                class="float-right"
            >
                <option
                    v-for="(room, index) in rooms"
                    :key="index"
                    :value="room"
                >
                    {{ room.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'rooms', 'currentRoom'
    ],
    data: function () {
        return {
            selectedRoom: ''
        }
    },
    created() {
        this.selectedRoom = this.currentRoom
    }
}
</script>
