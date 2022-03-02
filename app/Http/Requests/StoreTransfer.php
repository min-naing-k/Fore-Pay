<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransfer extends FormRequest
{

  protected $redirectRoute = 'transfer';

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
    $max_amount = auth()->user()->wallet?->amount ?? 0;
    return [
      'phone' => [
        'required',
        'min:9',
        Rule::exists('users')->where(function ($query) {
          return $query->where('phone', '!=', auth()->user()->phone ?? null);
        }),
      ],
      'amount' => 'required|integer|min:100|max:' . $max_amount,
    ];
  }

  public function messages()
  {
    return [
      'phone.exists' => '',
      'amount.min' => 'The amount must be at least 100 MMK',
      'amount.max' => 'You do not have sufficient balance',
    ];
  }

  protected function prepareForValidation()
  {
    if (strlen($this->phone) >= 9) {
      $user = User::where('phone', $this->phone)->first();
      if ($this->phone == auth()->user()->phone) {
        $this->session()->flash('status', 'fail');
        $this->session()->flash('data', "You can't transfer money to your account");
      } else if ($user) {
        $this->session()->flash('status', 'success');
        $this->session()->flash('data', $user->name);
      } else if (!$user) {
        $this->session()->flash('status', 'fail');
        $this->session()->flash('data', 'There is no user account');
      }
    }
  }
}
