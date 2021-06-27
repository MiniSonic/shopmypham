<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class CategoryCourseValidator extends BaseValidator
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

    public function validateStoreCategoryCourse($params = [], $id = '')
    {
        $rules = [
            'name' => 'bail|required|max:255',
            'status' => 'bail|nullable|in:0,1'
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'name' => 'Tên danh mục khóa học',
            'status' => 'Trạng thái',
        ];
    }
}