<?php

namespace App\Controllers;
use App\Models\AnnouncementModel;

class Announcement extends BaseController
{
    public function index()
    {
        $announcementModel = new AnnouncementModel();

        // Fetch announcements ordered by newest first
        $data['announcements'] = $announcementModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('announcements', $data);
    }
}