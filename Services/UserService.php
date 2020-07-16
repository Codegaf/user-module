<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;

class UserService {

    public function index() {
        return view('user::index');
    }

    public function create() {
        $breadcrumbs = [
            ['link' => config('app.url'), 'name' => __('menu.home')],
            ['name' => __('menu.users')],
            ['link' => route('user.create'), 'name' => __('menu.create')]
        ];

        return view('user::create', compact('breadcrumbs'));
    }

    public function list() {
        $users = User::select('*');

        dd($users);
    }

    public function store(array $data) {

        return response()->responseJson(true, 'Test');
    }
}