<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class AddSessionRequest extends FormRequest
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
            'title' => 'required',
            'type' => 'required',
            'teacher_id' => ['required', 'exists:users,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'schedule_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {

        $messageBag = collect($validator->errors()->messages());
        $message = implode('|', $messageBag->flatten()->toArray());
        throw new HttpResponseException(response()->json(['error' => true, 'message' => $message], Response::HTTP_UNPROCESSABLE_ENTITY));

    }
}
