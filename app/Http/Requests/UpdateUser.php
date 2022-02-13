<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $current_user_id = $this->route('user');
    return [
      'name' => 'required',
      'phone' => 'required|unique:users,phone,' . $current_user_id,
      'email' => 'required|unique:users,email,' . $current_user_id,
      'image' => 'image|mimes:png,jpg,jpeg',
    ];
  }
}
