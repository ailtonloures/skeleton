<?php
namespace App\Models;

use App\Services\AbstractModel;
use App\Services\ValidatorTrait;

class User extends AbstractModel
{
    use ValidatorTrait;

    protected $table = "user";
    protected $fields = ["id", "username", "email"];

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password'  => 'required|min:5',
        ];
    }

    protected function messages()
    {
        return [
            'required.*' => 'O valor é obrigatório.',
            'email.*' => 'E-mail inválido',
            'min.*' => 'O valor deve ter no mínimo :min caracteres'
        ];
    }

    public function scopeUserId($query, $id)
    {
        return $query->where(['id' => $id]);
    }
}