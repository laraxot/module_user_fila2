<?php

declare(strict_types=1);

namespace Modules\User\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

use function Safe\preg_match;

class Password implements Rule
{
    /**
     * The minimum length of the password.
     *
     * @var int
     */
    protected $length = 8;

    /**
     * Indicates if the password must contain one uppercase character.
     *
     * @var bool
     */
    protected $requireUppercase = false;

    /**
     * Indicates if the password must contain one numeric digit.
     *
     * @var bool
     */
    protected $requireNumeric = false;

    /**
     * Indicates if the password must contain one special character.
     *
     * @var bool
     */
    protected $requireSpecialCharacter = false;

    /**
     * The message that should be used when validation fails.
     *
     * @var string
     */
    protected $message;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = is_scalar($value) ? (string) $value : '';

        if ($this->requireUppercase && Str::lower($value) === $value) {
            return false;
        }

        if ($this->requireNumeric && ! preg_match('/[0-9]/', $value)) {
            return false;
        }

        if ($this->requireSpecialCharacter && ! preg_match('/[\W_]/', $value)) {
            return false;
        }

        return Str::length($value) >= $this->length;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        switch (true) {
            case $this->requireUppercase
            && ! $this->requireNumeric
            && ! $this->requireSpecialCharacter:
                return __('The :attribute must be at least :length characters and contain at least one uppercase character.', [
                    'length' => $this->length,
                ]);

            case $this->requireNumeric
            && ! $this->requireUppercase
            && ! $this->requireSpecialCharacter:
                return __('The :attribute must be at least :length characters and contain at least one number.', [
                    'length' => $this->length,
                ]);

            case $this->requireSpecialCharacter
            && ! $this->requireUppercase
            && ! $this->requireNumeric:
                return __('The :attribute must be at least :length characters and contain at least one special character.', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
            && $this->requireNumeric
            && ! $this->requireSpecialCharacter:
                return __('The :attribute must be at least :length characters and contain at least one uppercase character and one number.', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
            && $this->requireSpecialCharacter
            && ! $this->requireNumeric:
                return __('The :attribute must be at least :length characters and contain at least one uppercase character and one special character.', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
            && $this->requireNumeric
            && $this->requireSpecialCharacter:
                return __('The :attribute must be at least :length characters and contain at least one uppercase character, one number, and one special character.', [
                    'length' => $this->length,
                ]);

            case $this->requireNumeric
            && $this->requireSpecialCharacter
            && ! $this->requireUppercase:
                return __('The :attribute must be at least :length characters and contain at least one special character and one number.', [
                    'length' => $this->length,
                ]);

            default:
                return __('The :attribute must be at least :length characters.', [
                    'length' => $this->length,
                ]);
        }
    }
}
