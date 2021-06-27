<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class NewValidator extends BaseValidator
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

    public function validateStoreNew($params = [])
    {
        $rules = [
            'new_title' => 'bail|required|max:255',
            'new_short_description' => 'bail|max:255',
            'new_featured_image' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
            'status' => 'bail|nullable|in:0,1'
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'new_title' => 'Tiêu đề',
            'new_featured_image' => 'Ảnh đại diện',
            'new_content' => 'Nội dung bài viết',
            'new_short_description' => 'Mô tả ngắn',
            'status' => 'Trạng thái',
        ];
    }
}
