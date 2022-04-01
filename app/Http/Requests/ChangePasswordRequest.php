<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required'],
            'new_password' => ['required', 'min:4']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $messageBag = collect($validator->errors()->messages());
        $message = implode('|', $messageBag->flatten()->toArray());
        throw new HttpResponseException(response()->json(['error' => true, 'message' => $message], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
