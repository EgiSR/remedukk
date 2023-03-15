<?php
include 'layouts/header.php';
include 'layouts/navbar.php';
?>

    <!-- Hero -->
    <div class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1 class="text-white fw-bold mb-4">Kasir Restoran</h1>
                    <p class="text-white text-opacity-75">Website dengan sistem yang mempermudah untuk membeli makanan dan minuman.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Hero -->

    <div class="container mt-3">
        
        <!-- tentang -->
        <section id="menu">
            <div class="row about">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="fw-bold">Top Menu Makanan </h4>
                        <hr>
                        <div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <div class="col">
        <div class="card shadow-sm">
          <img src="assets/img/makanan/Resep-Sate-Kambing-Empuk.jpg" class="img-fluid" alt="kambing">
            <div class="card-body">
            <p class="card-title text-center"><b>SATE KAMBING EMPUK</b></p>
            <p class="card-text">Sate yang terbuat dari daging kambing yang baru di sembelih.</p>
            </div><!--card-body-->            
        </div><!--card-shadow-->
      </div><!--col-->
      <div class="col">
        <div class="card shadow-sm">
          <img src="assets/img/makanan/rendang.jpg" class="img-fluid" alt="rendang">
          <div class="card-body">
            <p class="card-title text-center"><b>Rendang</b></p>
            <p class="card-text">Makanan paling banyak diminati di seluruh dunia.</p>
          </div><!--card-body-->            
        </div><!--card-shadow-->
      </div><!--col-->
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/makanan/mie-goreng-korea.jpg" class="img-fluid" alt="mie">
              <div class="card-body">
                <p class="card-title text-center"><b>Mie Goreng Korea</b></p>
                <p class="card-text">Menu yang disukai oleh kalangan anak muda.</p>
            </div><!--card-body-->            
          </div><!--card-shadow-->
        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- akhir tentang -->
    </div>

    <?php 
    include 'layouts/footer.php'
    ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html> 