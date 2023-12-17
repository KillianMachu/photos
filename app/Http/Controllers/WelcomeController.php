<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function WelcomeShow(){
        $albums = Album::inRandomOrder()->take(3)->get();

        $photos = [];

        $users = [];

        foreach ($albums as $album) {
            $photos[] = Photo::whereRaw('LOWER(album_id) = ?', $album->id)->inRandomOrder()->first();
            $album->user_id ? $users[] = $album->user->name : $users[] = null;
        }

        return view('welcome', compact("albums", "photos", "users"));
    }
}
