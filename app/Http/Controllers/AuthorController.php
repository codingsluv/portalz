<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show($username)
    {

        $author = Author::where('username', $username)->first();

        return view('pages.authors.show', compact('author'));
    }
}
