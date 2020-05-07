<?php

namespace App\Traits;

use App\Services\File;
use Slim\Http\UploadedFile;

trait Validation
{

    /**
     * @var array $messages
     */
    protected static $messages;

    /**
     * @param string $input
     * @param string $message
     * @return void
     */
    protected static function setMessage(string $input, string $message): void
    {
        self::$messages[$input] = $message;
    }

    /**
     * @return array|null
     */
    protected static function messages(): ?array
    {
        if (!empty(self::$messages)) {
            return self::$messages;
        }

        return null;
    }

    /**
     * @param string $input
     * @param array $arr
     * @return boolean
     */
    protected static function emptyOrIsset(string $input, array $arr): bool
    {
        if (count($arr) >= 1) {
            if (!array_key_exists($input, $arr)) {
                self::setMessage($input, 'Este campo não existe');
                return false;
            }
        } else {
            self::setMessage('error', $message ?? 'Não há campos a serem validados');
            return false;
        }

        return true;
    }

    /**
     * @param string $input
     * @param string $value
     * @return void
     */
    protected static function email(string $input, string $message = null, string $value = null): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            self::setMessage($input, $message ?? 'E-mail inválido');
        }

    }

    /**
     * @param string $input
     * @param string $value
     * @return void
     */
    protected static function required(string $input, string $message = null, string $value = null): void
    {
        if (empty($value)) {
            self::setMessage($input, $message ?? 'Campo obrigatório');
        }

    }

    /**
     * @param string $input
     * @param float|integer $value
     * @return void
     */
    protected static function numeric(string $input, string $message = null, $value = null): void
    {
        if (!is_numeric($value)) {
            self::setMessage($input, $message ?? 'Não é um número válido');
        }

    }

    /**
     * @param string $input
     * @param float|integer $value
     * @param integer $max
     * @return void
     */
    protected static function max(string $input, string $message = null, $value = null, int $max = null): void
    {
        if (strlen($value) > $max) {
            self::setMessage($input, $message ?? "Este campo deve ter no máximo {$max} caracteres");
        }

    }

    /**
     * @param string $input
     * @param float|integer $value
     * @param integer $min
     * @return void
     */
    protected static function min(string $input, string $message = null, $value = null, int $min = null): void
    {
        if (strlen($value) < $min) {
            self::setMessage($input, $message ?? "Este campo deve ter no mínimo {$min} caracteres");
        }
    }

    /**
     * @param string $input
     * @param UploadedFile $fileInput
     * @param integer $max
     * @return void
     */
    protected static function size(string $input, string $message = null, UploadedFile $fileInput, int $max = null): void
    {
        $file = new File($fileInput);
        if ($file->size() > $max) {
            self::setMessage($input, $message ?? "Este arquivo deve ter no máximo {$max} Kb");
        }
    }

    /**
     * @param string $input
     * @param UploadedFile $fileInput
     * @param array $extensions
     * @return void
     */
    protected static function type(string $input, string $message = null, UploadedFile $fileInput, array $extensions = []): void
    {
        $file = new File($fileInput);
        if (!in_array($file->extension(), $extensions)) {
            self::setMessage($input, $message ?? 'Para esta ação só é permitido arquivos do tipo ' . implode(", ", $extensions));
        }
    }
}