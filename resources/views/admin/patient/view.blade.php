<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
                <thead>
                    <th scope="col">Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">division_id</th>
                    <th scope="col">division_id</th>

                </thead>
                <tr >
                    <td>{{($patient_data->f_name.' '.$patient_data->l_name) }}</td>
                    <td>{{($patient_data->user_name) }}</td>
                    <td>{{($patient_data->age) }}</td>
                    <td>{{($patient_data->phone) }}</td>
                    <td>{{($patient_data->gender) }}</td>
                    <td>{{($patient_data->address) }}</td>
                    <td>{{($patient_data->division_id) }}</td>
                    <td>{{($patient_data->division_id) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
