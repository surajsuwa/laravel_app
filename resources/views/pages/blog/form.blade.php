<div class="card-body">

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title"
            value="{{ isset($blog->title) ? $blog->title : old('title') }}" required>
        @error('title')
            <div class="alert alert-danger mt-1 mb-1">{{ $message . '*' }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" id="ckeditor1" name="description" rows="4" cols="50" required>{!! isset($blog->description) ? $blog->description : old('description') !!} </textarea>

        @error('description')
            <div class="alert alert-danger mt-1 mb-1">{{ $message . '*' }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Upload Image</label>
        <input type="file" name="image" class="form-control" placeholder="image">
    </div>

    <div class="form-group">
        <select class="form-select mb-3 w-20" name="is_active" id="is_active">
            <option value="none" selected disabled hidden>Status</option>
            <option value="1"{{ isset($blog->is_active) ? ($blog->is_active == 1 ? 'selected' : '') : '' }}>Active</option>
            <option value="0"{{ isset($blog->is_active) ? ($blog->is_active == 0 ? 'selected' : '') : '' }}>Inactive</option>
        </select>
    </div>

</div>

</div>
<!-- /.card-body -->

<div class="card-footer">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
