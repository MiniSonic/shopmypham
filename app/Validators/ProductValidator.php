<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class ProductValidator extends BaseValidator
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

    public function validateStoreProduct($params = [])
    {
        $rules = [
            'name' => 'required|max:255|',
            'category_id' => 'required',
            'price_origin' => 'required|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'sale' => 'nullable|numeric|min:0|',
            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'name' => 'Tên',
            'category_id' => 'Danh mục',
            'price_origin' => 'Giá gốc',
            'avatar' => 'Ảnh đại diện',
            'sale' => 'Khuyến mại',
        ];
    }
}
