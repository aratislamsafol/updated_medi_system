@extends('dashboard_master.admin_template')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

@section('patient') active @endsection
@section('main_content')

</nav>
<div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">All Patient</h6>

      <div class="panel-heading">
        <button class="btn btn-success" onclick="create()"><i class="glyphicon glyphicon-plus"></i>
            +New Patient Add
        </button>

    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 table-responsive">
                <table id="manage_all" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Blood Group</th>
                        <th>Created</th>
                        <th>Update</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div><!-- card -->


  </div><!-- sl-pagebody -->

    <!--========================  User Modal  section =================-->
    <div class="modal fade" id="modalUser" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title" id="myModalLabel"></p>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div id="modal_data"></div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
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
                        <label for="name" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="status" value="" name="status" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


    <style>
        @media screen and (min-width: 768px) {
            #modalUser .modal-dialog {
                width: 75%;
                border-radius: 5px;
            }
        }
    </style>
     <script>
        $(function () {
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('getall.patient') !!}',
                columns: [
                    {data: 'f_name', name: 'f_name'},
                    {data: 'l_name', name: 'l_name'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'address', name: 'address'},
                    {data: 'age', name: 'age'},
                    {data: 'blood_group', name: 'blood_group'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>
    <script type="text/javascript">

        function reload_table() {
            table.ajax.reload( null, false ); //reload datatable ajax
        }

        function create() {

            $("#modal_data").empty();
            $('.modal-title').text('New Patient Add'); // Set Title to Bootstrap modal title

            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')},
                type: 'GET',
                url: 'patients/create',
                success: function (data) {
                    $("#modal_data").html(data.html);
                    $('#modalUser').modal('show');
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        }


        $("#manage_all").on("click", ".edit", function () {

            $("#modal_data").empty();
            $('.modal-title').text('Edit Patients Information'); // Set Title to Bootstrap modal title

            var id = $(this).attr('id');

            $.ajax({
                url: '/patients/' + id + '/edit',
                type: 'get',
                success: function (data) {
                    $("#modal_data").html(data.html);
                    $('#modalUser').modal('show'); // show bootstrap modal
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        });

        $("#manage_all").on("click", ".view", function () {

            $("#modal_data").empty();
            $('.modal-title').text('View Events'); // Set Title to Bootstrap modal title

            var id = $(this).attr('id');

            $.ajax({
                url: '/patients/' + id,
                type: 'get',
                success: function (data) {
                    $("#modal_data").html(data.html);
                    $('#modalUser').modal('show'); // show bootstrap modal
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        });

    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#manage_all").on("click", ".delete", function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var id = $(this).attr('id');
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                }),
                $.ajax({
                    url: '/patients/' + id,
                    data: {"_token": CSRF_TOKEN},
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {

                        // reload_table();
                        if (data.type === 'success') {

                            swal.fire("Done!", "Successfully Deleted", "success");
                            reload_table();

                        } else if (data.type === 'danger') {

                            swal.fire("Error deleting!", "Try again", "error");

                        }
                    },
                });

            });
        });

    </script>

@stop
