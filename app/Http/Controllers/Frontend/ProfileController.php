<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UpdateProfile;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

  public function profile()
  {
    return view('frontend.profile');
  }

  public function profileEdit()
  {
    $user = auth()->user();
    return view('frontend.edit-profile', compact('user'));
  }

  public function profileUpdate(UpdateProfile $request, $id)
  {
    $user = User::findOrFail($id);
    $attributes = $request->validated();
    // delete old cover image
    if ($request->delete_cover_image && file_exists('storage/' . $request->delete_cover_image)) {
      Storage::disk('public')->delete($request->delete_cover_image);
      $attributes['cover_image'] = null;
    }

    // update new cover image
    if ($request->hasFile('cover_image')) {
      // delete old cover image
      if (file_exists('storage/' . $user->cover_image) && $user->cover_image) {
        Storage::disk('public')->delete($user->cover_image);
      }

      $attributes['cover_image'] = $request->file('cover_image')->store('user/cover');
    }

    // delete old profile image
    if ($request->delete_profile_image && file_exists('storage/' . $request->delete_profile_image)) {
      Storage::disk('public')->delete($request->delete_profile_image);
      $attributes['image'] = null;
    }

    // upload new profile image
    if ($request->hasFile('profile_image')) {
      // delete old profile image
      if (file_exists('storage/' . $user->image) && $user->image) {
        Storage::disk('public')->delete($user->image);
      }

      $attributes['image'] = $request->file('profile_image')->store('user/profile');
    }

    $user->update($attributes);

    return redirect()->route('profile')->with('update', 'Profile is updated successfully!');
  }

  public function editPassword()
  {
    return view('frontend.edit-password');
  }

  public function updatePassword(UpdatePassword $request, $id)
  {
    $user = User::findOrFail($id);
    $user->update([
      'password' => $request->password,
    ]);

    return redirect()->route('profile')->with('update', 'Password is Change.');
  }

}
