<table id="bookingTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <td>Consumer Name</td>
            <td>Gender</td>
            <td>Age</td>
            <td>Aadhar Number</td>
            <td>Id Proof</td>
            <td>Is Covid Positive</td>
            <td>Data From Covid Positive</td>
            <td>Address</td>
            <td>Phone</td>
            <td>Cylinder Type</td>
            <td>Status</td>
            <td>State</td>
            <td>City</td>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{$booking['name']}}</td>
            <td>{{$booking['gender']}}</td>
            <td>{{$booking['age']}}</td>
            <td>{{$booking['addar_number']}}</td>
            <td><img src="<?php echo asset($booking["id_proof"]); ?>"/></td>
            <td>{{ $booking['is_covid_positve'] ? 'Yes' : 'No' }}</td>
            <td>{{$booking['covid_positive_date']}}</td>
            <td>{{$booking['address']}}</td>
            <td>{{$booking['phone']}}</td>
            <td>{{$booking['cylinder_type']}}</td>
            <td>
                <select size="1" class="booking_status" data-id="{{$booking['id']}}" id="{{$booking['id']}}_status" name="{{$booking['id']}}_status">
                    <option value="0" <?php if($booking['status'] == '0'){ ?> selected="selected" <?php } ?>>
                        pending
                    </option>
                    <option value="1" <?php if($booking['status'] == '1'){ ?> selected="selected" <?php } ?>>
                        processing
                    </option>
                    <option value="2" <?php if($booking['status'] == '2'){ ?> selected="selected" <?php } ?>>
                        delivered
                    </option>
                    <option value="3" <?php if($booking['status'] == '3'){ ?> selected="selected" <?php } ?>>
                        cancelled
                    </option>
                </select>
            </td>
            <td>{{$booking['state']}}</td>
            <td>{{$booking['city_name']}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>Consumer Name</td>
            <td>Gender</td>
            <td>Age</td>
            <td>Aadhar Number</td>
            <td>Id Proof</td>
            <td>Is Covid Positive</td>
            <td>Data From Covid Positive</td>
            <td>Address</td>
            <td>Phone</td>
            <td>Cylinder Type</td>
            <td>Status</td>
            <td>State</td>
            <td>City</td>
        </tr>
    </tfoot>
</table>

<script>
var baseUrl = "<?php echo env('APP_URL'); ?>";

var updateBookingStatus = function(booking_id, booking_status) {
    $.ajax({
        url: baseUrl + '/booking/update/status/'+booking_id,
        method: 'patch',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            booking_status : booking_status
        },
        success: function(res){
            console.log(res.data);
        }
    }).done();
};

$(document).ready(function() {
    $('#bookingTable').DataTable({
        columnDefs: [{
            targets: [11]
        }]
    });

    $('.booking_status').change(function(){
        var booking_id = $(this).data('id');
        var booking_status = $(this).val();
        updateBookingStatus(booking_id, booking_status);
    })
} );
</script>