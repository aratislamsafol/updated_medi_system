<form id='edit' action="{{ route('patients.update', $data->id) }}" enctype="multipart/form-data" method="post" >

    <div class="box-body">
        <div id="status"></div>
           {{method_field('PATCH')}}

           {{-- <div class="form-group col-md-10 col-sm-12">
            <label for="tour_image">Brand Name</label>
            <input type="text" class="form-control" id="brand_name"  name="brand_name" value="{{ csrf_token() }}
                   placeholder="" required>
            <span id="error_first_name" class="has-error"></span>
        </div> --}}

        <div class="form-group col-md-10 col-sm-12">
            <label for="f_name">First Name</label>
            <input type="text" class="form-control" id="f_name"  name="f_name" value="{{ $data->f_name }}"
                   placeholder="" required>
            <span id="error_first_name" class="has-error"></span>
        </div>

        <div class="form-group col-md-10 col-sm-12">
            <label for="l_name">Last Name</label>
            <input type="text" class="form-control" id="l_name"  name="l_name" value="{{ $data->l_name }}"
                   placeholder="" required>
            <span id="error_l_name" class="has-error"></span>
        </div>

        <div class="form-group col-md-10 col-sm-12">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone"  name="phone" value="{{ $data->phone }}"
                   placeholder="" required>
            <span id="error_phone" class="has-error"></span>
        </div>


        <div class="form-group col-md-10 col-sm-12">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email"  name="email" value="{{ $data->email }}"
                   placeholder="" required>
            <span id="error_email" class="has-error"></span>
        </div>

        <div class="form-group col-md-10 col-sm-12">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address"  name="address" value="{{ $data->address }}"
                   placeholder="" required>
            <span id="error_address" class="has-error"></span>
        </div>

        @php
            $divisions = App\Models\Division::orderBy('priority', 'asc')->get();
        @endphp
        <select class="form-select" aria-label="Default select example" id="division_id" value="{{ $data->division_id }}"  name="division_id">
            <option selected>Division Id</option>
            @foreach ($divisions as $divi)
            <option value="{{$divi->id}}">{{$divi->name}}</option>
            @endforeach
        </select>
        @php
            $districts = App\Models\District::orderBy('name', 'asc')->get();
        @endphp

        <select class="form-select" aria-label="Default select example" id="district_id"  value="{{ $data->district_id }}" name="district_id">

        </select>

        <select class="form-select" aria-label="Default select example" id="blood_group"   name="blood_group">
            <option selected >{{ $data->blood_group}}</option>
            <option>AB+</option>
            <option>AB-</option>
            <option>A+</option>
            <option>A-</option>
            <option>B+</option>
            <option>B-</option>
            <option>0+</option>
            <option>0-</option>
        </select>

        <div class="form-group col-md-10 col-sm-12">
            <label for="age">Age</label>
            <input type="number" class="form-control" id="age"  name="age" value="{{ $data->age }}"
                   placeholder="" required>
            <span id="error_age" class="has-error"></span>
        </div>

        <select class="form-select" aria-label="Default select example" id="gender" name="gender">
            <option selected>{{ $data->gender}}</option>
            <option>Male</option>
            <option>Female</option>
            <option>Others</option>
        </select>



        <div class="form-group col-md-10 col-sm-12">
            <label for="password">password</label>
            <input type="password" class="form-control" id="password"  name="password"
                   placeholder="" required>
            <span id="error_password" class="has-error"></span>
        </div>

        <div class="form-group col-md-10 col-sm-12">
            <label for="tour_image">status</label>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <select class="form-select" aria-label="Default select example" id="status"  name="status">
                <option selected>Select Status</option>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
                <option value="3">Suspended</option>
            </select>
            {{-- <input type="text" class="form-control" id="status" name="status"
                   placeholder="" required> --}}
            <span id="error_first_name" class="has-error"></span>
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
        $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                // tour_image: {
                //     required: true
                // }
            },
            // Messages for form validation
            messages: {
                // tour_image: {
                //     required: 'Please enter Tour image'
                // }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#edit")[0]);

                $.ajax({
                    // headers: {'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('patients.update', $data->id) }}",
                    type: 'post',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    success: function (data) {

                        $("#status").html(data.html);
                        reload_table();
                        $('#loader').hide();
                        $("#submit").prop('disabled', false); // disable button
                        $("html, body").animate({scrollTop: 0}, "slow");
                        $('#modalUser').modal('hide'); // hide bootstrap modal
                    },
                    error:function(error){

                    // Swal.fire({
                    //     text: 'Course name Already added! try another',
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
