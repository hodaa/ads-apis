<?php

namespace App\Http\Requests;

use App\Enums\TypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'=>'required|'.Rule::in(TypeEnum::getConstList()),
            'title'=>'required',
            'category_id'=>'required|exists:categories,id',
            'advertiser_id'=>'required|exists:users,id',
            'start_date' => 'required|date_format:Y-m-d',
            'tags.*'=> 'required|exists:tags,id'

        ];
    }
}
