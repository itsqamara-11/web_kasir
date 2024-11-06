<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu2");
while ($row = mysqli_fetch_array($query)) {
  $result[] = $row;
}

$query_chart = mysqli_query($conn, "SELECT nama_menu, tb_daftar_menu2.id, SUM(tb_list_order.jumlah) AS total_jumlah 
FROM tb_daftar_menu2 
LEFT JOIN tb_list_order ON tb_daftar_menu2.id = tb_list_order.menu
GROUP BY tb_daftar_menu2.id
ORDER BY tb_daftar_menu2.id ASC");

// $result_chart = array();
while ($record_chart = mysqli_fetch_array($query_chart)) {
  $result_chart[] = $record_chart;
}

$array_menu = array_column($result_chart, 'nama_menu');
$array_menu_qoute = array_map(function($menu){
  return "'".$menu."'";
}, $array_menu);
$string_menu = implode(',', $array_menu_qoute);
// echo $string_menu."<br>";

$array_jumlah_pesanan = array_column($result_chart, 'total_jumlah');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);
// echo $string_jumlah_pesanan;

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="col-lg-9 mt-2">
  <!-- Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <?php
      $slide = 0;
      $firstSlideButton = true;
      foreach ($result as $dataTombol) {
        ($firstSlideButton) ? $aktif = "active" : $aktif = "";
        $firstSlideButton = false;
      ?>

        <button type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="<?php echo $slide ?>" class="<?php echo $aktif ?>"
          aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
      <?php
        $slide++;
      } ?>
    </div>
    <div class="carousel-inner rounded">
      <?php
      $firstSlide = true;
      foreach ($result as $data) {
        ($firstSlide) ? $aktif = "active" : $aktif = "";
        $firstSlide = false;
      ?>
        <div class="carousel-item <?php echo $aktif ?>">
          <img src="assets/img/<?php echo $data['foto'] ?>" class="img-fluid" style="height: 250px; width:1000px; object-fit: cover" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5><?php echo $data['nama_menu'] ?></h5>
            <p><?php echo $data['keterangan'] ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- Akhir Carousel -->

  <!-- Judul -->
  <div class="card mt-4 border-0 bg-light">
    <div class="card-body text-center">
      <h5 class="card-title">COZCAFE - APLIKASI PEMESANAN MAKANAN & MINUMAN CAFE</h5>
      <p class="card-text">Aplikasi pemesanan makanan dan minuman yang mudah dan praktis. Nikmati hidangan favorit anda dengan beberapa langkah. Pesan, bayar dan lacak pesanan anda dengan mudah melalui aplikasi ini.</p>
      <a href="order" class="btn btn-secondary">Mulai Order</a>
    </div>
  </div>
  <!-- Akhir Judul -->

  <!-- Chart -->
  <div class="card mt-4 border-0 bg-light">
    <div class="card-body text-center">
      <div>
        <canvas id="myChart"></canvas>
      </div>
      <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [<?php echo $string_menu ?>],
            datasets: [{
              label: 'Jumlah Porsi Terjual',
              data: [<?php echo $string_jumlah_pesanan ?>],
              borderWidth: 1,
              backgroundColor:[
                'rgba(245, 39, 102, 0.45)',
                'rgba(0, 96, 234, 0.64)',
                'rgba(234, 255, 93, 0.64)',
                'rgba(0, 202, 27, 0.64)',
                'rgba(195, 20, 239, 0.64)',
                'rgba(246, 150, 52, 0.64)',
                'rgba(245, 39, 72, 0.8)',
                'rgba(39, 245, 238, 0.8)',
                'rgba(2, 25, 146, 0.8)',
                'rgba(99, 2, 146, 0.8)',
                'rgba(123, 64, 3, 0.8)',
                'rgba(123, 3, 3, 0.8)',
                'rgba(115, 66, 127, 1)',
                'rgba(66, 127, 123, 1)'
              ] 
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>

      <a href="order" class="btn btn-secondary">Mulai Order</a>
    </div>
  </div>
  <!-- Akhir Chart -->
</div>