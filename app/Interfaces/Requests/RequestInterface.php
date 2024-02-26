<?php

namespace App\Interfaces\Requests;

interface RequestInterface
{
    /**
     * Get the validation rules for the request class.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array;
}
