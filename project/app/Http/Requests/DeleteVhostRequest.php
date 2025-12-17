<?php

namespace App\Http\Requests;

use App\Rules\ValidDomain;
use Illuminate\Foundation\Http\FormRequest;

class DeleteVhostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => ['required', 'string', new ValidDomain()],
        ];
    }

    public function validationData(): array
    {
        return [
            'domain' => $this->route('domain'),
        ];
    }
}
