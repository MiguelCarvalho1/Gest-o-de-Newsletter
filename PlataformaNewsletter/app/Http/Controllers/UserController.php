<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function countUserNewslettersAndNews($userId)
    {
        $user = User::findOrFail($userId);

        $newsletterCount = $user->newsletters()->count();
        $newsCount = $user->news()->count();

        return [
            'newsletter_count' => $newsletterCount,
            'news_count' => $newsCount,
        ];
    }
}
