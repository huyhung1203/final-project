@extends('layout.master')
@section('title', 'Home')
@section('name_page', 'dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $invoice_count }}</h3>
                    <p>Hoá Đơn</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ url('invoice') }}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($total) }} vnd </h3>

                    <p>Doanh thu</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('revenue') }}" class="small-box-footer">Chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $user }}</h3>

                    <p>Khách hàng</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ url('user') }}" class="small-box-footer">Chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $product_count }}</h3>

                    <p>Sản phẩm sắp hết hàng</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ url('product/sold-out') }}" class="small-box-footer">Chi tiết <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="chart">
        <div class="header">
            <h4>Thống kê doanh thu</h4>
        </div>
        <div style="width:70%">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // const ctx = document.getElementById('myChart');

        // Lấy canvas element từ DOM
        // var ctx = document.getElementById('myChart').getContext('2d');

        // // Gọi AJAX để lấy dữ liệu từ controller và đổ vào biểu đồ
        // $.ajax({
        //     url: '/admin/get-data-chart', // URL endpoint của controller để lấy dữ liệu
        //     method: 'GET',
        //     success: function(data) {
        //         // Dữ liệu trả về từ controller
        //         var chartData = {
        //             labels: data.labels,
        //             datasets: [{
        //                 label: '# of Votes',
        //                 data: data.votes,
        //                 borderWidth: 1
        //             }]
        //         };

        //         // Tạo biểu đồ
        //         new Chart(ctx, {
        //             type: 'bar',
        //             data: chartData,
        //             options: {
        //                 scales: {
        //                     y: {
        //                         beginAtZero: true
        //                     }
        //                 }
        //             }
        //         });
        //     },
        //     error: function(error) {
        //         console.log('Đã xảy ra lỗi khi lấy dữ liệu từ server.');
        //     }
        // });

        document.addEventListener('DOMContentLoaded', function() {
            // Get the revenue data from the server-side (e.g., Laravel variable)
            var revenueData = @json($revenue);

            // Extract the labels (months) and data (total amounts) from the revenue data
            var labels = [];
            var data = [];
            var currentDate = new Date();

            // Loop through the last 12 months and fill in the data for each month
            for (var i = 0; i < 12; i++) {
                var targetDate = new Date(currentDate);
                targetDate.setMonth(targetDate.getMonth() - i);

                var targetMonth = targetDate.toISOString().slice(0, 7);
                var matchingData = revenueData.find(item => item.month === targetMonth);

                labels.unshift(targetMonth);
                data.unshift(matchingData ? matchingData.total : 0);
            }
            // Create the chart
            var ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Revenue',
                        data: data,
                        borderWidth: 1,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Adjust the background color as needed
                        borderColor: 'rgba(75, 192, 192, 1)', // Adjust the border color as needed
                        borderWidth: 1,
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
        });
    </script>
@endsection
@endsection
