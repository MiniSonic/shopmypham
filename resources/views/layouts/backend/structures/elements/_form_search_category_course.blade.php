<div class="my-select2">
    <select class="my-select2__select2 select2-wrapper" name="category_course_id">
        <option selected readonly value="">--- Danh mục ---</option>
        @foreach($list as $item)
            <option value="{{ arrayGet($item, 'id') }}" {{ $categoryCourseId == arrayGet($item, 'id') ? "selected" : '' }}>{{ arrayGet($item, 'name') }}</option>
        @endforeach
    </select>
</div>