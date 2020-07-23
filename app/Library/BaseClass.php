<?php

namespace App\Library;
use App;
use App\Folder;
use Illuminate\Support\Facades\Auth;

class BaseClass{
  public static function getfolders($request) {
    $folders = Folder::where('user_id', Auth::id())->get();
    return $folders;
  }
}