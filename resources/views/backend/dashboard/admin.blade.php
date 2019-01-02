@extends('template.backend.template')

@section('nav')
<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
@endsection

@section('content')
<div class="row clearfix">
  <div class="card">
      <div class="header">
          <h2>
              DASHBOARD
          </h2>
      </div>
      <div class="body">
        <h3 style="text-align: center;">Grafik Transaksi Kos Setahun Terakhir</h3>
        <canvas id="line_chart" height="150"></canvas>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    var chartData = {
        type: 'line',
        data: {
            labels: [
            @php
            for ($i=0; $i <= 11; $i++) {
                  $array[] = $pustaka->tanggalIndoStringBulanTahun(date("m-Y", strtotime("-" . $i . " months")));
            }
            foreach (array_reverse($array) as $item) {
                  echo '"'.$item.'",';
             }
             unset($array);
            @endphp
            ],
            datasets: [{
                label: "Jumlah Transaksi",
                data: [
                @php
                for ($i=0; $i <= 11; $i++) {
                      $bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
                      $tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];
                      $array[] = DB::select("
                            SELECT count(*) total
                            FROM transaksi
                            WHERE month(waktu_validasi) = ?
                            AND year(waktu_validasi) = ?
                            AND status = 'a'
                      ", [$bulan, $tahun])[0]->total;             
                }
                foreach (array_reverse($array) as $item) {
                      echo '"'.$item.'",';
                 }
                 unset($array);
                @endphp
                ],
                borderColor: 'rgba(0, 188, 212, 0.75)',
                backgroundColor: 'rgba(0, 188, 212, 0.3)',
                pointBorderColor: 'rgba(0, 188, 212, 0)',
                pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                pointBorderWidth: 1
            }]
        },
        options: {
            responsive: true,
            legend: false
        }
    }
    new Chart(document.getElementById("line_chart").getContext("2d"), chartData);
</script>
@endsection