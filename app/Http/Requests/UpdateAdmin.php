<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdmin extends FormRequest
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
    $current_admin_id = $this->route('admin_user');
    return [
      'name' => 'required',
      'phone' => 'required|unique:admins,phone,' . $current_admin_id,
      'email' => 'required|unique:admins,email,' . $current_admin_id,
      'image' => 'image|mimes:png,jpg,jpeg',
    ];
  }
}
