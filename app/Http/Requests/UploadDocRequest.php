<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UploadDocRequest extends FormRequest
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
            'document_name' => ['required'],
            'document' => ['required', 'max:100000', 'mimes:doc,docx,pdf,mpeg,jpg,jpeg,png,odt']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $messageBag = collect($validator->errors()->messages());
        $message = implode('|', $messageBag->flatten()->toArray());
        throw new HttpResponseException(response()->json(['error' => true, 'message' => $message], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
