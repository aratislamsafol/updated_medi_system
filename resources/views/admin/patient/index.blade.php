
@extends('dashboard_master.admin_template')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap.css">
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>

@section('patient') active @endsection
@section('main_content')

<div class="row p-4">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Patient</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" onClick="add()" href="javascript:void(0)">+New Patient</a>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>user_name</th>
                    <th>Status</th>
                    <th>Phone</th>
                    <th>Email</th>
                    {{-- <th>address</th> --}}
                    {{-- <th>age</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Gender</th>
                    <th>blood_group</th> --}}
                    <th>Created</th>
                    {{-- <th>Update</th> --}}
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
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="f_name">First Name</label>
                        <input type="text" class="form-control" id="f_name"  name="f_name" value=""
                               placeholder="" required>
                        <span id="error_first_name" class="has-error"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        <label for="l_name">Last Name</label>
                        <input type="text" class="form-control" id="l_name"  name="l_name" value=""
                               placeholder="" required>
                        <span id="error_first_name" class="has-error"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="tour_image">Phone</label>
                        <input type="text" class="form-control" id="phone"  name="phone" value=""
                               placeholder="" required>
                        <span id="error_phone" class="has-error"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address"  name="address" value=""
                               placeholder="" required>
                        <span id="error_address" class="has-error"></span>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="division_id">Division_id</label>
                        <input type="text" class="form-control" id="division_id"  name="division_id" value=""
                               placeholder="" required>
                        <span id="error_division_id" class="has-error"></span>
                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        <label for="district_id">District ID</label>
                        <input type="text" class="form-control" id="district_id"  name="district_id" value=""
                               placeholder="" required>
                        <span id="error_district_id" class="has-error"></span>
                    </div>
                </div>

                <div class="row">


                    <select class="form-select form-control col-md-4 col-sm-12"  id="blood_group"  name="blood_group" aria-label="Default select example">
                        <span id="error_blood_group" class="has-error"></span>
                        <option selected>Blood Group</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>0+</option>
                        <option>0-</option>
                      </select>

                      <select class="form-select form-control col-md-4 col-sm-12"  id="gender"  name="gender" aria-label="Default select example">
                        <span id="error_gender" class="has-error"></span>
                        <option selected>Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Others</option>

                      </select>

                      <select class="form-select form-control col-md-4 col-sm-12"  id="status"  name="status" aria-label="Default select example">
                        <span id="error_status" class="has-error"></span>
                        <option selected>Status</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>

                </div>

                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="gender">Age</label>
                        <input type="number" class="form-control" id="age"  name="age" value=""
                               placeholder="" required>
                        <span id="error_age" class="has-error"></span>
                    </div>
                </div>


                <div class="form-group col-md-12 col-sm-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email"  name="email"
                           placeholder="" required>
                    <span id="error_email" class="has-error"></span>
                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password"  name="password"
                            required>
                    <span id="error_password" class="has-error"></span>
                </div>

                    {{-- <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Priority</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="priority" value="" name="priority" maxlength="50" required="">
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
    ajax: "{{ route('patients.index') }}",
    columns: [
        {data: 'f_name', name: 'f_name'},
        {data: 'l_name', name: 'l_name'},
        {data: 'user_name', name: 'user_name'},
        {data: 'status', name: 'status'},
        {data: 'phone', name: 'phone'},
        {data: 'email', name: 'email'},
        // {data: 'address', name: 'address'},

        // {data: 'age', name: 'age'},
        // {data: 'division_id', name: 'division_id'},
        // {data: 'district_id', name: 'district_id'},
        // {data: 'gender', name: 'gender'},
        // {data: 'blood_group', name: 'blood_group'},

        {data: 'created_at', name: 'created_at'},
        // {data: 'updated_at', name: 'updated_at'},
        {data: 'action', name: 'action'}
    ],
    order: [[0, 'desc']]
        });
    });

    function add(){
        $('#CompanyForm').trigger("reset");
        $('#CompanyModal').html("Patient ADD");
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
    url: "{{ url('delete/patient') }}",
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
    url: "{{ route('patients.store')}}",
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
