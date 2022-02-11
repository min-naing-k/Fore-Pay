<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmin;
use App\Http\Requests\UpdateAdmin;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

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
    if ($request->hasFile('image')) {
      $attributes['image'] = $request->file('image')->store('admin/profile');
    }
    $admin = Admin::create($attributes);
    return redirect()->route('admin.admin-user.index')->with('create', "New Admin ($admin->name) is Created");
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $admin = Admin::findOrFail($id);
    return view('backend.admin-user.edit', compact('admin'));
  }

  public function update(UpdateAdmin $request, $id)
  {
    $admin = Admin::findOrFail($id);
    $attributes = $request->validated();

    // update password
    if ($request->password && strlen($request->password) >= 6) {
      $attributes['password'] = $request->password;
    } else if ($request->password && strlen($request->password) < 6) {
      return back()->withErrors(['password' => 'Password must be at least 6 characters!']);
    }

    // delete old image
    if ($request->delete_profile_image) {
      if (file_exists('storage/' . $request->delete_profile_image)) {
        Storage::disk('public')->delete($request->delete_profile_image);
        $attributes['image'] = null;
      }
    }

    // update old image
    if ($request->hasFile('image')) {
      if (file_exists('storage/' . $admin->image)) {
        Storage::disk('public')->delete($admin->image);
      }
      $attributes['image'] = $request->file('image')->store('admin/profile');
    }

    $admin->update($attributes);

    return redirect()->route('admin.admin-user.index')->with('update', 'Admin User is updated successfully!');
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
