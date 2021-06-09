@extends('layouts.consumer.default')

@section('content')

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <div class="mb-3" style="borderRadius:10px; marginTop:24px; padding:20px; background:#82c3d0;">
        <h5>Register Supplier</h5>
        <form method="POST" action="{{ route('bookCylinder') }}" enctype="multipart/form-data">
            @csrf

                <div class="mb-3">
                    <label htmlFor="consumer_name">Name</label>
                    <input type="text" name="consumer_name" class="form-control" id="consumer_name" placeholder="Enter name"/>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="stateSelector">
                    <label>Select State</label>
                    <select id="consumer_state" name="consumer_state" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                        <option selected>Select State</option>
                        @foreach ($states as $state)
                        <option data-code="{{$state['code']}}" value="{{$state['id']}}">{{$state['name']}}</option>
                        @endforeach
                    </select>
                    @error('consumer_state')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="citySelector">
                    <label>Select Your City</label>
                    <select id="consumer_city" name="consumer_city" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                    </select>
                    @error('consumer_city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="supplierSelector">
                    <label>Supplier Name</label>
                    <select id="supplier_name" name="supplier_id" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                    </select>
                    @error('supplier_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Select Gender</label>
                    <select name="consumer_gender" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                        <option selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('consumer_gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label htmlFor="consumer_age">Age</label>
                    <input type="number" name="consumer_age" class="form-control" id="consumer_age" placeholder="Enter age"/>
                    @error('consumer_age')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label htmlFor="consumer_aadhar_num">Aadhar Numbber</label>
                    <input type="text" name ="consumer_aadhar_num" class="form-control" id="consumer_aadhar_num" placeholder="Enter Aadhar Number"/>
                    @error('consumer_aadhar_num')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="consumer_idproof" class="form-label">Upload ID Proof</label>
                    <input name="consumer_idproof" class="form-control" type="file" id="consumer_idproof">
                    @error('consumer_idproof')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Is Covid Positive</label>
                    <select id="is_covid_poritive" name="is_covid_poritive" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                        <option selected value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    @error('is_covid_poritive')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="covideDatePicker" style="display:none;">
                    <label htmlFor="datepicker">Date of Tested Covid Positive</label>
                    <input type="text" name ="covid_positive_date" class="form-control" id="datepicker"/>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                    <textarea name="consumer_address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('consumer_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label htmlFor="consumer_phone_num">Phone Number</label>
                    <input type="number" name="consumer_phone_num" class="form-control" min="1000000000" max="9999999999" id="consumer_phone_num" placeholder="Enter Phone Number"/>
                    @error('consumer_phone_num')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" id="oxygenSelecter">
                    <label>Available Oxygens Cylinders</label>
                    <select id="book_oxygen_cylinder" name="book_oxygen_cylinder" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                    </select>
                    @error('book_oxygen_cylinder')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>
</div>

<script>
var baseUrl = "<?php echo env('APP_URL'); ?>";

var getCitiesByState = function(state_code) {
    $.ajax({
        url: baseUrl + '/get-cities-by-state',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            state_code : state_code
        },
        success: function(res){
            $('#consumer_city').empty();
            $.each(res.response, function(key, data) {
                $('#consumer_city')
                    .append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.city_name)); 
            });
        }
    }).done();
};

var getSupplierByState = function(state_code) {
    $.ajax({
        url: baseUrl + '/get-supplier-by-state',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            state_id : state_code
        },
        success: function(res){
            console.log(res);
            $('#supplier_name').empty()
                    .append("<option>Select Supplier</option>");
            $.each(res.response, function(key, data) {
                $('#supplier_name')
                    .append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.name));
            });
        }
    }).done();
}

var getCylinderbySupplierId = function(supplier_id) {
    $.ajax({
        url: baseUrl + '/get-cylinder-by-supplier',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            supplier_id : supplier_id
        },
        success: function(res){
            console.log(res);
            $('#book_oxygen_cylinder').empty()
                    .append("<option>Select Uxygen Cylinder Type</option>");
            $.each(res.response, function(key, data) {
                $('#book_oxygen_cylinder')
                    .append($("<option></option>")
                                .attr("value", key)
                                .text(key));
            });
        }
    }).done();
}

$( function() {

    $( "#datepicker" ).datepicker();

    $('#consumer_state').change(function(){
        var state_code = $(this).find(':selected').data('code');
        var state_id = $(this).find(':selected').attr('value');
        getCitiesByState(state_code);
        getSupplierByState(state_id);
    })

    $('#is_covid_poritive').change(function(){
        if($(this).val() == 1) {
            $('#covideDatePicker').show();
        } else {
            $('#covideDatePicker').hide();
        }
    });

    $('#supplier_name').change(function(){
        var supplier_id = $(this).find(':selected').attr('value');
        getCylinderbySupplierId(supplier_id);
    });
} );
</script>

@endsection