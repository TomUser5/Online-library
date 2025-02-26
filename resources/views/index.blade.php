@extends('layout')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
  }
  .parallax {
          background-image: url('/images/myimage.jpg');
            height: 80vh;
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .parallax .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 3rem;
        }

        /* Hide the div initially */
        .hidden-content {
            display: none;
        }
</style>

<div class="parallax">
        <div class="content" style="font-weight: bold;">
            Знанието на един клик
        </div>
    </div>

    <!-- Hidden content section -->
    <div class="container mt-5">
        <div class="row hidden-content" id="numberSection">
            <div class="col text-center">
                <h2>Numbers:</h2>
                <p id="number">0</p>
            </div>
        </div>
    </div>

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



    <script>
        // JavaScript to show the hidden content when scrolling
        window.addEventListener('scroll', function () {
            const numberSection = document.getElementById('numberSection');
            const numberElement = document.getElementById('number');
            const scrollPosition = window.scrollY;
            
            // Show the hidden section when the user scrolls down
            if (scrollPosition > 500) {
                numberSection.style.display = 'block';

                // Add a simple animation to increase the number value
                let count = 0;
                const interval = setInterval(() => {
                    if (count < 100) {
                        count += 1;
                        numberElement.textContent = count;
                    } else {
                        clearInterval(interval);
                    }
                }, 50);
            } else {
                numberSection.style.display = 'none';
            }
        });
    </script>

@endsection