<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
  public function index()
  {
    $admins = Admin::orderBy('id', 'asc')
      ->paginate(10)
      ->withQueryString();
    return view('backend.admin-user.index', compact('admins'));
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    //
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    //
  }

  public function update(Request $request, $id)
  {
    //
  }

  public function destroy($id)
  {
    //
  }
}
