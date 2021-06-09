<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">OSPMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="{{ route('bookCylinder') }}">Book Oxygen Cylinder</a>
        <a class="nav-link" href="{{ route('supplier.login') }}">Supplier Login</a>
        <a class="nav-link" href="{{ route('supplier.register') }}">Supplier Register</a>
      </div>
    </div>
  </div>
</nav>