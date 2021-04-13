<?php

namespace Database\Seeders;

use App\Models\ChatRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatRoomSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            ['name' => 'General'],
            ['name' => 'Tech Talk'],
        ];
        foreach ($rooms as $room) {
            DB::table(ChatRoom::query()->getModel()->getTable())->insert($room);
        }
    }
}
