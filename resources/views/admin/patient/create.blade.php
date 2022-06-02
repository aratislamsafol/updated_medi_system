<form id='create' action="" enctype="multipart/form-data" method="post"
      accept-charset="utf-8">
      @csrf
    <div class="box-body">
        <div id="status"></div>
        <div class="row">
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
                <span id="error_l_name" class="has-error"></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone"  name="phone" value=""
                       placeholder="" required>
                <span id="error_phone" class="has-error"></span>
            </div>


            <div class="form-group col-md-6 col-sm-12">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email"  name="email" value=""
                       placeholder="" required>
                <span id="error_email" class="has-error"></span>
            </div>
        </div>


        <div class="form-group col-md-12 col-sm-12">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address"  name="address" value=""
                   placeholder="" required>
            <span id="error_address" class="has-error"></span>
        </div>

        <div class="row p-2">
            @php
            $divisions = App\Models\Division::orderBy('priority', 'asc')->get();
        @endphp
        <select class="form-select col-md-4" aria-label="Default select example" id="division_id"  name="division_id">
            <option selected>Division Id</option>
            @foreach ($divisions as $divi)
            <option value="{{$divi->id}}">{{$divi->name}}</option>
            @endforeach
        </select>
        @php
            $districts = App\Models\District::orderBy('name', 'asc')->get();
        @endphp

        <select class="form-select col-md-4" aria-label="Default select example" id="district_id"  name="district_id">

        </select>

        <select class="form-select col-md-4" aria-label="Default select example" id="blood_group"  name="blood_group">
            <option selected>Select Blood Group</option>
            <option>AB+</option>
            <option>AB-</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>0+</option>
            <option>0-</option>
        </select>

        </div>

        <div class="row p-2">
            <div class="form-group col-md-4 col-sm-12">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age"  name="age" value=""
                       placeholder="" required>
                <span id="error_age" class="has-error"></span>
            </div>

            <select class="form-select col-md-4" aria-label="Default select example" id="gender"  name="gender">
                <option selected>Select Gender Please</option>
                <option>Male</option>
                <option>Female</option>
                <option>Others</option>
            </select>

            <select class="form-select col-md-4" aria-label="Default select example" id="status"  name="status">
                <option selected>Select Status</option>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
                <option value="3">Suspended</option>
            </select>

        </div>



        <div class="form-group col-md-10 col-sm-12">
            <label for="password">password</label>
            <input type="password" class="form-control" id="password"  name="password" value=""
                   placeholder="" required>
            <span id="error_password" class="has-error"></span>
        </div>

        <div class="clearfix"></div>
        <div class="form-group col-md-12">
            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- /.box-body -->
</form>

<script type="text/javascript">
    $(document).ready(function()
   {
       $("#division_id").change(function(){
           var division = $("#division_id").val();
           // Send an ajax request to server with this division
           $("#district_id").html("");
           var option = "";

           $.get( "http://127.0.0.1:8000/get-districts/"+division, function( data ) {

               data = JSON.parse(data);
               data.forEach( function(element) {
                 option += "<option value='"+ element.id +"'>"+ element.name +"</option>";
               });

             $("#district_id").html(option);

           });
       })
   })

</script>
<script>
    $(document).ready(function () {
        $('#loader').hide();
        $('#create').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
            },
            // Messages for form validation
            messages: {

            },
            submitHandler: function (form) {

                var myData = new FormData($("#create")[0]);

                $.ajax({
                    headers: {'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')},
                    url: "{{ route('patients.store') }}",
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();

                        // $("#submit").prop('disabled', false); // disable button
                    },
                    success: function (data) {
                        // Swal.fire({
                        // position: 'top-end',
                        // icon: 'success',
                        // title: 'Your work has been saved',
                        // showConfirmButton: false,
                        // timer: 1500
                        // }),
                        reload_table();
                        $("#status").html(data.html);

                        $('#loader').hide();
                        $("#submit").prop('disabled', false); // disable button
                        $("html, body").animate({scrollTop: 0}, "slow");
                        $('#modalUser').modal('hide'); // hide bootstrap modal
                    },
                    error:function(error){

                        console.error(error)
                        // console.log(error.responseJSON.errors);
                    // Swal.fire({
                    //     text: 'Event Name already added Or file is not jpg,png,jpeg',
                    //     icon: 'error',
                    //     confirmButtonText: 'Ok'
                    //     })
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>





