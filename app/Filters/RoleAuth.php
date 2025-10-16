<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = $session->get('role');

        // If not logged in
        if (!$role) {
            return redirect()->to('/login');
        }

        $uri = $request->uri->getPath(); // current route

        // Admin role
        if ($role === 'admin') {
            if (strpos($uri, 'admin') !== 0) {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        }

        // Teacher role
        elseif ($role === 'teacher') {
            if (strpos($uri, 'teacher') !== 0) {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        }

        // Student role
        elseif ($role === 'student') {
            if (strpos($uri, 'student') !== 0 && strpos($uri, 'announcements') !== 0) {
                $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to('/announcements');
            }
        }

        return; // Allow access
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No modification needed after response
    }
}