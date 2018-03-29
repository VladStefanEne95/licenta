<?php

namespace App\Http\ViewComposers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\User;

class UserComposer
{
    public function compose(View $view) {
        $users = User::all();
        $view->with('users', $users);
    }
}
