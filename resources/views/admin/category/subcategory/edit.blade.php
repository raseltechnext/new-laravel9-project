<form action="{{ route('subcategory.update') }}" method="Post">
  @csrf
  <div class="modal-body">
    <div class="form-group">
      <label for="category_name">Category Name</label>
      <select class="form-control" name="category_id" required="">
        @foreach($category as $row)
        <option value="{{ $row->id }}" @if($row->id == $data->category_id) selected="" @endif>{{ $row->category_name }}</option>
        @endforeach
      </select>
      <input type="hidden" name="id" value="{{ $row->id }}">
    </div>
    <div class="form-group">
      <label for="subcategory_name">Sub Category Name</label>
      <input type="text" class="form-control" name="subcategory_name" value="{{ $data->subcategory_name }}" placeholder="Enter Sub Category Name" required>
      <small id="emailHelp" class="form-text text-muted">Sub Category</small>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>