<?php
/**
 * Created by PhpStorm.
 * User: andresdkm
 * Date: 26/09/18
 * Time: 04:57 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateAdministradorCondominioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(){
        return [
            'name' => 'required|max:255',
            'password' => 'confirmed|min:6'
        ];
    }

}