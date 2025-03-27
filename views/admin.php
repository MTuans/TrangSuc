<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-5 " style="padding-bottom:20px;">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="/web2-php/admin" class="list-group-item list-group-item-action">Trang chủ</a>
                <a href="/web2-php/admin-pro" class="list-group-item list-group-item-action">Quản lý sản phẩm</a>
                <a href="/web2-php/admin-cate" class="list-group-item list-group-item-action">Quản lý danh mục</a>
                <a href="/web2-php/admin-user" class="list-group-item list-group-item-action">Quản lý người dùng</a>
                <a href="/web2-php/admin-order" class="list-group-item list-group-item-action">Quản lý đơn hàng</a>
            </div>
        </div>
        <div class="col-lg-9">
            <h2 class="text-center">Thống kê</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Số lượng đơn hàng</h5>
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lượt truy cập</h5>
                            <canvas id="visitsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const orderData = <?= json_encode($orderStats) ?>;

        if (!orderData || orderData.length === 0) {
            console.error("Không có dữ liệu đơn hàng!");
            return;
        }

        const orderLabels = orderData.map(item => 'Tháng ' + item.thang);
        const orderValues = orderData.map(item => item.so_luong);

        const ctxOrders = document.getElementById('ordersChart').getContext('2d');
        new Chart(ctxOrders, {
            type: 'bar',
            data: {
                labels: orderLabels,
                datasets: [{
                    label: 'Đơn hàng',
                    data: orderValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            }
        });
    });


    const ctxVisits = document.getElementById('visitsChart').getContext('2d');
    new Chart(ctxVisits, {
        type: 'line',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
            datasets: [{
                label: 'Lượt truy cập',
                data: [5000, 7000, 8000, 12000, 15000],
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false
            }]
        }
    });
</script>