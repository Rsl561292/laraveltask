<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Category;
use App\Article;

class ArticleRequest extends FormRequest
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
            //'id',
            'category_id' => [
                'required',
                'integer',
                Rule::in(array_flip(Category::getListId())),
            ],
            'title' => [
                'required',
                'string',
                'max:140',
                Rule::unique('articles')->ignore($this->input('id'), 'id')
             ],
            'content' => 'required|string',
            'status' => [
                'required',
                'integer',
                Rule::in(array_flip(Article::getStatusList())),
            ],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Please select category your article',
            'category_id.in' => 'Selected category not found. Please select category your article again',
            'content.required' => 'Please enter text your article',
            'status.required' => 'Please select status your article',
            'status.in' => 'Selected status not found. Please select status your article again',
        ];
    }
}
