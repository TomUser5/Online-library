@extends('layout')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
  }
</style>

<section class="container mt-3">
  
  @if(session()->has('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="container mt-5">
    <div class="row">
      <!-- Total Books -->
      <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h3 class="card-title mb-0">1,245</h3>
              <p class="card-text">Total Books</p>
            </div>
            <div class="icon">
              <i class="fa fa-book fa-2x"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Materials -->
      <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h3 class="card-title mb-0">3,578</h3>
              <p class="card-text">Total Materials</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder fa-2x"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Active Users -->
      <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h3 class="card-title mb-0">350</h3>
              <p class="card-text">Active Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users fa-2x"></i>
            </div>
          </div>
        </div>
      </div>

</section>

@endsection