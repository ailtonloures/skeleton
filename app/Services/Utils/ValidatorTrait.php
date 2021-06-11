<?php
namespace App\Services\Utils;

use Validator\Validator;

trait ValidatorTrait
{
    /** @var Validator $validator */
    protected $validator;

    /**
     * @param array $target
     * @return self
     */
    public function validate(array $target)
    {
        $rules      = method_exists($this, 'rules') ? $this->rules() : [];
        $messages   = method_exists($this, 'messages') ? $this->messages() : [];
        $attributes = method_exists($this, 'attributes') ? $this->attributes() : [];

        $this->validator = Validator::make($target, $rules, $messages, $attributes);

        return $this;
    }

    /**
     * @return boolean
     */
    public function invalid(): bool
    {
        return $this->validator->invalid();
    }

    /**
     * @param boolean $json
     * @return array
     */
    public function getValidationErrors(bool $json = false): array
    {
        return $this->validator->fails($json);
    }
}
