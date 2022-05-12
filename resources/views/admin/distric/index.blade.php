@extends('Admin.template_master');
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
@section('district') active @endsection
@section('main_content')

<div class="row p-4">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>District</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Distric</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="district_datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Distric Name</th>
                    <th>Division Id</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- boostrap company model -->
<div class="modal fade" id="company-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CompanyModal"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Division Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="district_name" name="district_name" placeholder="Enter Divison Name" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="division_id">Select a division for this district</label>
                        <div class="col-sm-12">
                            @php
                                $divisions = App\Models\Division::orderBy('prioroty', 'asc')->get();
                            @endphp
                            <select class="form-control" name="division_id">
                            <option value="">Please select a division for the district</option>

                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" id="division_id">{{ $division->division_name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="division_id" value="" name="division_id" maxlength="50" required="">
                        </div>
                    </div> --}}

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#district_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('district_datatable') }}",
    columns: [
    { data: 'id', name: 'id' },
    { data: 'district_name', name: 'district_name' },
    { data: 'division_id', name: 'division_id' },
    { data: 'created_at', name: 'created_at' },
    {data: 'action', name: 'action', orderable: false},
    ],
    order: [[0, 'desc']]
    });
    });
    function add(){
        $('#CompanyForm').trigger("reset");
        $('#CompanyModal').html("Distric ADD");
        $('#company-modal').modal('show');
        $('#id').val('');
    }

    // function viewfun(id){
    // $.ajax({
    //     type:"GET",
    //     url: "{{ url('view-division') }}",
    //     data: { id: id },
    //     dataType: 'json',
    //     success: function(res){
    //         $('#view').html("View Divison");
    //         $('#modal_view').modal('show');
    //         $('#id').val(res.id);
    //         $('#division_name').val(res.division_name);
    //         // $('#status').val(res.status);
    //     }
    // });
    // }

    function editFunc(id){
    $.ajax({
        type:"POST",
        url: "{{ url('edit-distric') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#CompanyModal').html("Edit Division");
            $('#company-modal').modal('show');
            $('#id').val(res.id);
            $('#district_name').val(res.district_name);
            $('#division_id').val(res.division_id);
        }
    });
    }

    function deleteFunc(id){
    if (confirm("Delete Record?") == true) {
    var id = id;
    // ajax
    $.ajax({
    type:"POST",
    url: "{{ url('delete-district') }}",
    data: { id: id },
    dataType: 'json',
    success: function(res){
    var oTable = $('#district_datatable').dataTable();
    oTable.fnDraw(false);
    }
    });
    }
    }
    $('#CompanyForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type:'POST',
    url: "{{ url('store-distric')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
    $("#company-modal").modal('hide');
    var oTable = $('#district_datatable').dataTable();
    oTable.fnDraw(false);
    $("#btn-save").html('Submit');
    $("#btn-save"). attr("disabled", false);
    },
    error: function(data){
    console.log(data);
    }
    });
    });
    </script>
  @stop
