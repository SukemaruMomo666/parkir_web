<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('plate_number') && is_string($this->input('plate_number'))) {
            $this->merge([
                'plate_number' => strtoupper(preg_replace('/\s+/', ' ', trim($this->input('plate_number')))),
            ]);
        }

        if ($this->has('type') && is_string($this->input('type'))) {
            $this->merge([
                'type' => strtolower(trim($this->input('type'))),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plate_number' => [
                'required',
                'string',
                'min:3',
                'max:15',
                'regex:/^[A-Z0-9\s-]+$/i',
                'unique:vehicles,plate_number',
            ],
            'type' => ['required', 'string', 'in:car,motorcycle,ev'],
            'make' => ['nullable', 'string', 'max:50'],
            'model' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'max:30'],
            'is_default' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom validation messages in Indonesian.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'plate_number.required' => 'Nomor pelat kendaraan wajib diisi.',
            'plate_number.string' => 'Nomor pelat kendaraan harus berupa teks.',
            'plate_number.min' => 'Nomor pelat kendaraan minimal 3 karakter.',
            'plate_number.max' => 'Nomor pelat kendaraan maksimal 15 karakter.',
            'plate_number.regex' => 'Format nomor pelat kendaraan tidak valid (hanya huruf, angka, spasi, dan tanda hubung).',
            'plate_number.unique' => 'Nomor pelat kendaraan ini sudah terdaftar di sistem.',
            'type.required' => 'Jenis kendaraan wajib dipilih.',
            'type.in' => 'Jenis kendaraan tidak valid. Pilihan yang tersedia: car, motorcycle, ev.',
            'make.max' => 'Merek kendaraan maksimal 50 karakter.',
            'model.max' => 'Model kendaraan maksimal 50 karakter.',
            'color.max' => 'Warna kendaraan maksimal 30 karakter.',
            'is_default.boolean' => 'Nilai default harus bernilai boolean (true atau false).',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Data kendaraan tidak valid',
            'errors' => $validator->errors(),
        ], 422));
    }
}

