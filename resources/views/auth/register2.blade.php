@extends('layouts.consumer.default')

@section('content')
<div class="container">
    <div class="mb-3" style="borderRadius:10px; marginTop:24px; padding:20px; background:#82c3d0;">
        <h5>Register Supplier</h5>
        <form method="POST" action="{{ route('supplier.register') }}" enctype="multipart/form-data">
            @csrf

                <div class="mb-3">
                    <label htmlFor="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"/>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label htmlFor="email">Email address</label>
                    <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"/>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Select Gender</label>
                    <select name="gender" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                        <option selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label htmlFor="age">Age</label>
                    <input type="number" name="age" class="form-control" id="age" placeholder="Enter age"/>
                    @error('age')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label htmlFor="aadhar_num">Aadhar Numbber</label>
                    <input type="text" name ="aadhar_num" class="form-control" id="aadhar_num" placeholder="Enter Aadhar Number"/>
                    @error('aadhar_num')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="idproof" class="form-label">Upload ID Proof</label>
                    <input name="idproof" class="form-control" type="file" id="idproof">
                    @error('idproof')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Select State</label>
                    <select id="supplier_state" name="state" class="form-select form-select-small mb-3" aria-label=".form-select-lg example">
                        <option selected>Select State</option>
                        @foreach ($states as $state)
                        <option data-code="{{$state['code']}}" value="{{$state['id']}}">{{$state['name']}}</option>
                        @endforeach
                    </select>
                    @error('state')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Select City</label>
                    <select id="supplier_city" name="supplier_city" class="form-select form-select-small mb-3" aria-label=".form-select-lg example"></select>
                    @error('supplier_city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label htmlFor="phone_num">Phone Number</label>
                    <input type="number" name="phone_num" class="form-control" min="1000000000" max="9999999999" id="phone_num" placeholder="Enter Phone Number"/>
                    @error('phone_num')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label htmlFor="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password"/>
                    @error('password')
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
            $('#supplier_city').empty();
            $.each(res.response, function(key, data) {
                $('#supplier_city')
                    .append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.city_name));
            });
        }
    }).done();
};

$( function() {

    $('#supplier_state').change(function(){
        var state_code = $(this).find(':selected').data('code');
        getCitiesByState(state_code);
    })

} );
</script>

@endsection