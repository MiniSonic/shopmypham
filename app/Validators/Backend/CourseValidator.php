<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class CourseValidator extends BaseValidator
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

    public function validateStoreCourse($params = [], $id = '')
    {
        $rules = [
            'name' => 'bail|required|max:255',
            'teacher_id' => 'bail|required',
            'category_course_id' => 'bail|required',
            'price_origin' => 'bail|nullable|numeric|min:0',
            'price' => 'bail|nullable|numeric|min:0',
            'the_number_of_students' => 'bail|nullable|numeric|min:0',
            'the_number_of_rates' => 'bail|nullable|numeric|min:0',
            'sale' => 'bail|nullable|numeric|min:0',
            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
            'status' => 'bail|nullable|in:0,1',
            'short_description' => 'nullable|string|max:255'
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'name' => 'Tên khóa học',
            'teacher_id' => 'Giáo viên',
            'category_course_id' => 'Danh mục khóa học',
            'price_origin' => 'Giá gốc',
            'price' => 'Giá bán',
            'the_number_of_students' => 'Học viên',
            'the_number_of_rates' => 'Số lượt đánh giá',
            'sale' => 'Giá khuyến mại',
            'avatar' => 'Ảnh đại diện',
            'status' => 'Trạng thái',
        ];
    }
}