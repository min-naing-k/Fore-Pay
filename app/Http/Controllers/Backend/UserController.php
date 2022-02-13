<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UUIDGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function index()
  {
    return view('backend.user.index');
  }

  public function showAllAdmins()
  {
    if (request()->ajax()) {
      $selected_users_id = request('selected_users_id');
      $selected_users_id = $selected_users_id ? explode(',', $selected_users_id) : [];
      $limit = request('limit', 5);
      $field = request('field', 'updated_at');
      $direction = request('direction', null);
      $users = User::orderBy($field, $direction ?? 'desc')
        ->filter(request(['search']))
        ->paginate($limit)
        ->withQueryString();
      return view('components.backend.user-table', compact('users', 'field', 'direction', 'selected_users_id'))->render();
    }

    return back();
  }

  public function create()
  {
    return view('backend.user.create');
  }

  public function store(StoreUser $request)
  {
    $attributes = $request->validated();
    $profile_image_path = null;
    DB::beginTransaction();
    try {
      // create user
      if ($request->hasFile('image')) {
        $attributes['image'] = $request->file('image')->store('user/profile');
        $profile_image_path = $attributes['image'];
      }
      $user = User::create($attributes);

      // create wallet
      Wallet::firstOrCreate([
        'user_id' => $user->id,
      ], [
        'account_number' => UUIDGenerate::accountNumber(),
        'amount' => 0,
      ]);

      DB::commit();
      return redirect()->route('admin.user.index')->with('create', "New User ($user->name) is Created");
    } catch (Exception $e) {
      if ($profile_image_path && file_exists('storage/' . $profile_image_path)) {
        Storage::disk('public')->delete($profile_image_path);
      }
      DB::rollBack();
      return redirect()->route('admin.user.create')->with('error', "Something went wrong!");
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $user = User::findOrFail($id);
    return view('backend.user.edit', compact('user'));
  }

  public function update(UpdateUser $request, $id)
  {
    $user = User::findOrFail($id);
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
      if (file_exists('storage/' . $user->image)) {
        Storage::disk('public')->delete($user->image);
      }
      $attributes['image'] = $request->file('image')->store('user/profile');
    }

    $user->update($attributes);

    return redirect()->route('admin.user.index')->with('update', 'User is updated successfully!');
  }

  public function destroy($id)
  {
    $user = User::find($id);
    if (!$user) {
      return response()->json('User Not Found!');
    }

    if ($user->image && file_exists('storage/' . $user->image)) {
      Storage::disk('public')->delete($user->image);
    }

    $user->delete();
    return response()->json(['status' => 'Success', 'message' => 'User is deleted Successfully!']);
  }

  public function destroySelected($selected_users_id)
  {
    $selected_users_id = $selected_users_id ? explode(',', $selected_users_id) : [];
    foreach ($selected_users_id as $id) {
      $user = User::find($id);
      if (!$user) {
        return response()->json('User User Not Found');
      }

      if ($user->image && file_exists('storage/' . $user->image)) {
        Storage::disk('public')->delete($user->image);
      }

      $user->delete();
    }

    return response()->json(['status' => 'Success', 'message' => 'User is deleted Successfully!']);
  }
}
