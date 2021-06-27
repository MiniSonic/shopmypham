<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;

class TeacherValidator extends BaseValidator
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

    public function validateStoreTeacher($params = [], $teacherId = '')
    {
        $rules = [
            'teacher_fullname' => 'bail|required|max:64',
            'teacher_word_place' => 'bail|required|max:64',
            'teacher_email' => 'bail|required|max:64|unique:teachers,teacher_email,' . $teacherId,
            'teacher_subject' => 'max:64',
            'teacher_degree' => 'max:64',
            'teacher_avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
            'teacher_link_facebook' => 'max:128',
            'teacher_followed_number' => 'bail|nullable|numeric|min:0',
            'the_number_of_students' => 'bail|nullable|numeric|min:0',
            'teacher_years_of_experience_number' => 'bail|nullable|numeric|min:0',
            'status' => 'bail|nullable|in:0,1'
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'teacher_fullname' => 'Tên giảng viên',
            'teacher_word_place' => 'Nơi công tác',
            'teacher_email' => 'Địa chỉ email',
            'teacher_subject' => 'Môn giảng dạy',
            'teacher_degree' => 'Học vị',
            'teacher_avatar' => 'Ảnh đại diện',
            'teacher_link_facebook' => 'Địa chỉ facebook',
            'teacher_followed_number' => 'Lượt theo dõi',
            'the_number_of_students' => 'Số học viên',
            'teacher_years_of_experience_number' => 'Năm kinh nghiệm',
            'status' => 'Trạng thái',
        ];
    }
}
