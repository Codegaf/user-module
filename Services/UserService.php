<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Hash;
use Modules\User\DataTables\UsersDataTable;
use Modules\User\Entities\User;

class UserService {

    public function index(UsersDataTable $usersDataTable) {
        $breadcrumbs = [
            ['link' => config('app.url'), 'name' => __('menu.home')],
            ['link' => route('user.index'), 'name' => __('menu.users')],
            ['link' => route('user.create'), 'name' => __('menu.create')]
        ];

        return $usersDataTable->render('user::index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function create() {
        $breadcrumbs = [
            ['link' => config('app.url'), 'name' => __('menu.home')],
            ['link' => route('user.index'), 'name' => __('menu.users')],
            ['link' => route('user.create'), 'name' => __('menu.create')]
        ];

        return view('user::create', compact('breadcrumbs'));
    }

    public function store(array $data) {

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        if (request()->wantsJson()) {
            return response()->okJson();
        }

        return response()->okView('user.index');
    }

    public function update(array $data, User $user) {

        if (array_key_exists('password', $data) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        else {
            unset($data['password']);
        }

        $user->fill($data)->update();

        return response()->okView('user.index');
    }

    public function edit(User $user) {
        $breadcrumbs = [
            ['link' => config('app.url'), 'name' => __('menu.home')],
            ['link' => route('user.index'), 'name' => __('menu.users')],
            ['link' => route('user.edit', ['user' => $user->id]), 'name' => __('global.edit')]
        ];

        return view('user::edit', compact('user', 'breadcrumbs'));
    }

    public function destroy(User $user) {
        $user->delete();

        return response()->okJson();
    }
}