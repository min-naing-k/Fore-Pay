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
    if (request()->ajax()) {
      $selected_admins_id = request('selected_admins_id');
      $selected_admins_id = $selected_admins_id ? explode(',', $selected_admins_id) : [];
      $limit = request('limit', 5);
      $field = request('field', 'id');
      $direction = request('direction', null);
      $admins = Admin::orderBy($field, $direction ?? 'asc')
        ->filter(request(['search']))
        ->paginate($limit);
      $admins->appends(request()->except(['selected_admins_id']));
      return view('components.backend.table', compact('admins', 'field', 'direction', 'selected_admins_id'))->render();
    }

    return back();
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
