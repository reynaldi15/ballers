<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
  public function login() {
    $user = User::all();
    return [
      'name'
    ];
  }

  public function register() {
    $user = User::all();
    return [
      'name'
    ];
  }

  public function listUser() {
    $user = User::all();
    return [
      'name'
    ];
  }

  public function getUser() {
    $user = User::all();
    return [
      'name'
    ];
  }

  public function verifyUser() {
    $user = User::all();
    return [
      'name'
    ];
  }

  public function getProfile() {
    $user = User::all();
    return [
      'name'
    ];
  }

  public function getDeletedUser() {
    $user = User::all();
    return [
      'name'
    ];
  }
}
