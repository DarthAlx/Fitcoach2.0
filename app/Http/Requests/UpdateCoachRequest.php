<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 27/09/18
 * Time: 02:33 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCoachRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'password' => 'confirmed|min:6'
        ];
    }

}
