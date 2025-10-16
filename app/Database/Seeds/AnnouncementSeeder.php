<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'      => 'Welcome Back Students!',
                'content'    => 'The new semester starts next week. Please check your schedules.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title'      => 'System Maintenance',
                'content'    => 'The portal will be offline on Saturday for maintenance.',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}php spark db:seed AnnouncementSeeder