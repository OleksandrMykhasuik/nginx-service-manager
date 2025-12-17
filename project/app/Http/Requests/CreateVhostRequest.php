<?php

namespace App\Http\Requests;

use App\Rules\ValidDomain;
use Illuminate\Foundation\Http\FormRequest;

class CreateVhostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => ['required', 'string', new ValidDomain()],
            'port' => ['required', 'integer', 'min:8000', 'max:8999'],
            'rootPath' => ['required', 'string'],
            'ssl' => ['sometimes', 'boolean'],
            'sslCertPath' => ['sometimes', 'string', 'nullable'],
            'sslKeyPath' => ['sometimes', 'string', 'nullable'],
        ];
    }
}
