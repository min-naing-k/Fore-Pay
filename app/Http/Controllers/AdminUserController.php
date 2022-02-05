<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
  public function index()
  {
    return view('backend.admin-user.index');
  }

  public function showAllAdmins()
  {
    $limit = request('limit', 5);
    $field = request('field', 'id');
    $direction = request('direction', null);
    $admins = Admin::orderBy($field, $direction ?? 'asc')
      ->filter(request(['search']))
      ->paginate($limit)
      ->withQueryString();
    return view('components.backend.table', compact('admins', 'field', 'direction'))->render();
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
