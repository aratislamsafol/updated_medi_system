
@extends('dashboard_master.admin_template')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap.css">
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>

@section('division') active @endsection
@section('main_content')

<div class="row p-4">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Divison</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Divison</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="division_datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>division_name</th>
                    <th>Priority</th>
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
                            <input type="text" class="form-control" id="division_name" name="division_name" placeholder="Enter Divison Name" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="priority" value="" name="priority" maxlength="50" required="">
                        </div>
                    </div>

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

{{-- View Modal --}}
<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="view">Division View</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 table-responsive">
                    <table id="CompanyForm" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                              <th scope="col"><p><b>Name : </b><span id="view_category_name" class="text-success"></span></p></th>
                              <th scope="col"><p><b>Company Name : </b><span id="status" class="text-success"></span></p></th>

                            </tr>
                          </thead>

                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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

    $('#division_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('division.all') }}",
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'priority', name: 'priority' },
        { data: 'created_at', name: 'created_at' },
        {data: 'action', name: 'action', orderable: false},
    ],
    order: [[0, 'desc']]
        });
    });

    function add(){
        $('#CompanyForm').trigger("reset");
        $('#CompanyModal').html("Category ADD");
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
        url: "{{ url('edit-division') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#CompanyModal').html("Edit Division");
            $('#company-modal').modal('show');
            $('#id').val(res.id);
            $('#division_name').val(res.name);
            $('#priority').val(res.priority);
        }
    });
    }

    function deleteFunc(id){
    if (confirm("Delete Record?") == true) {
    var id = id;
    // ajax
    $.ajax({
    type:"POST",
    url: "{{ url('delete-division') }}",
    data: { id: id },
    dataType: 'json',
    success: function(res){
    var oTable = $('#division_datatable').dataTable();
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
    url: "{{ url('store-division')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
    $("#company-modal").modal('hide');
    var oTable = $('#division_datatable').dataTable();
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
