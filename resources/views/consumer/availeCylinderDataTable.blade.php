<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <td>Supplier Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Oxygen Cylinder 5 Ltr Qty</td>
            <td>Oxygen Cylinder 10 Ltr Qty</td>
            <td>Oxygen Cylinder 15 Ltr Qty</td>
            <td>State</td>
            <td>City</td>
        </tr>
    </thead>
    <tbody>
    @foreach($suppliersData as $supplier)
        <tr>
            <td>{{$supplier['name']}}</td>
            <td>{{$supplier['email']}}</td>
            <td>{{$supplier['phone']}}</td>
            <td>{{$supplier['5_ltr_qty']}}</td>
            <td>{{$supplier['10_ltr_qty']}}</td>
            <td>{{$supplier['15_ltr_qty']}}</td>
            <td>{{$supplier['state']}}</td>
            <td>{{$supplier['city_name']}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>Supplier Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Oxygen Cylinder 5 Ltr Qty</td>
            <td>Oxygen Cylinder 10 Ltr Qty</td>
            <td>Oxygen Cylinder 15 Ltr Qty</td>
            <td>State</td>
            <td>City</td>
        </tr>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>