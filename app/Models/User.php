<?php
namespace App\Models;

use App\Services\Database\AbstractModel;
use App\Services\ValidatorTrait;

class User extends AbstractModel
{
    use ValidatorTrait;

    protected $table  = "user";
    protected $fields = ["id", "username", "password"];

    protected function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|min:5',
        ];
    }

    protected function messages()
    {
        return [
            'required.*' => 'O valor é obrigatório.',
            'min.*'      => 'O valor deve ter no mínimo :min caracteres',
        ];
    }

    public function scopeUserId($query, $id)
    {
        return $query->where(['id' => $id]);
    }
}
