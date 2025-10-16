<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            // Redirect based on role if already logged in
            return $this->redirectByRole($session->get('userRole'));
        }

        return view('Auth/login');
    }

    public function attempt()
    {
        $request = $this->request;
        $email = trim((string) $request->getPost('email'));
        $password = (string) $request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set([
                'isLoggedIn' => true,
                'userId'     => $user['id'],
                'userEmail'  => $user['email'],
                'userName'   => $user['name'],
                'userRole'   => $user['role'], // store role
            ]);

            // Redirect based on user role
            return $this->redirectByRole($user['role']);
        }

        return redirect()->back()->with('login_error', 'Invalid credentials');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

    public function register()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return $this->redirectByRole($session->get('userRole'));
        }

        return view('Auth/register');
    }

    public function store()
    {
        $name = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $passwordConfirm = (string) $this->request->getPost('password_confirm');

        if ($name === '' || $email === '' || $password === '' || $passwordConfirm === '') {
            return redirect()->back()->withInput()->with('register_error', 'All fields are required.');
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->with('register_error', 'Invalid email address.');
        }

        if ($password !== $passwordConfirm) {
            return redirect()->back()->withInput()->with('register_error', 'Passwords do not match.');
        }

        $userModel = new UserModel();

        // Check for existing email
        if ($userModel->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('register_error', 'Email is already registered.');
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $userId = $userModel->insert([
            'name'     => $name,
            'email'    => $email,
            'role'     => 'student', // default role for new users
            'password' => $passwordHash,
        ], true);

        if (! $userId) {
            return redirect()->back()->withInput()->with('register_error', 'Registration failed.');
        }

        return redirect()
            ->to(base_url('login'))
            ->with('register_success', 'Account created successfully. Please log in.');
    }

    /**
     * Redirect user based on their role
     */
    private function redirectByRole($role)
    {
        switch ($role) {
            case 'student':
                return redirect()->to(base_url('announcements'));
            case 'teacher':
                return redirect()->to(base_url('teacher/dashboard'));
            case 'admin':
                return redirect()->to(base_url('admin/dashboard'));
            default:
                return redirect()->to(base_url('login'));
        }
    }
}