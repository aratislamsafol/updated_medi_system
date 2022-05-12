{{-- <input data-id="{{$cat_status->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $cat_status->status ? 'checked' : '' }}> --}}

{{-- <a href="javascript:void(0)" data-toggle="tooltip" onClick="active({{ $id }})" data-original-title="Active" class="edit btn btn-success edit">
    Active
</a>

<a href="javascript:void(0)" data-toggle="tooltip" onClick="active({{ $id }})" data-original-title="Inactive" class="edit btn btn-success edit">
    Inactive
</a> --}}

{{-- <a href="{{url('status'.$cat->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></a> --}}

{{-- <a href="javascript:void(0)" data-toggle="tooltip" onClick="viewfun({{ $id }})" data-original-title="View" class="view btn btn-success view">
    View
</a> --}}
<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $id }})" data-original-title="Edit" class="edit btn btn-success edit">
    Edit
</a>
<a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc({{ $id }})" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
    Delete
</a>
