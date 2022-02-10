<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmin;
use App\Models\Admin;

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
      $admins = Admin::orderBy($field, $direction ?? 'desc')
        ->filter(request(['search']))
        ->paginate($limit)
        ->withQueryString();
      return view('components.backend.table', compact('admins', 'field', 'direction', 'selected_admins_id'))->render();
    }

    return back();
  }

  public function create()
  {
    return view('backend.admin-user.create');
  }

  public function store(StoreAdmin $request)
  {
    $attributes = $request->validated();
    $admin = Admin::create($attributes);
    return redirect()->route('admin.admin-user.index')->with('create', "New Admin ($admin->name) is Created");
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    //
  }

  public function update($id)
  {
    //
  }

  public function destroy($id)
  {
    $admin = Admin::find($id);
    if (!$admin) {
      return response()->json('Admin User Not Found!');
    }

    $admin->delete();
    return response()->json(['status' => 'Success', 'message' => 'Admin User is deleted Successfully!']);
  }

  public function destroySelected($selected_admins_id)
  {
    $selected_admins_id = $selected_admins_id ? explode(',', $selected_admins_id) : [];
    foreach ($selected_admins_id as $id) {
      $admin = Admin::find($id);
      if (!$admin) {
        return response()->json('Admin User Not Found');
      }

      $admin->delete();
    }

    return response()->json(['status' => 'Success', 'message' => 'Admin User is deleted Successfully!']);
  }
}
