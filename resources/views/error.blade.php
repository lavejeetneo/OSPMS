@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<h2>Opps! Somthing Went Wrong</h2>