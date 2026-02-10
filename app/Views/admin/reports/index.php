<?= $this->extend('admin/layouts/master') ?>

<?= $this->section('title') ?>
Laporan Penjualan - Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chart-bar me-2"></i>Laporan Penjualan</h1>
        <div class="btn-group">
            <a href="<?= base_url('admin/reports/export/pdf?'.http_build_query($_GET)) ?>" 
               class="btn btn-danger" target="_blank">
                <i class="fas fa-file-pdf me-2"></i>Export PDF
            </a>
            <a href="<?= base_url('admin/reports/export/excel?'.http_build_query($_GET)) ?>" 
               class="btn btn-success">
                <i class="fas fa-file-excel me-2"></i>Export Excel
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
        </div>
        <div class="card-body">
            <form method="get" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" 
                           value="<?= $startDate ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" name="end_date" class="form-control" 
                           value="<?= $endDate ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Produk</label>
                    <select name="product_id" class="form-select">
                        <option value="">Semua Produk</option>
                        <?php foreach($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= $productId == $product['id'] ? 'selected' : '' ?>>
                            <?= esc($product['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $categoryId == $category['id'] ? 'selected' : '' ?>>
                            <?= esc($category['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="<?= base_url('admin/reports') ?>" class="btn btn-secondary">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Produk Terjual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= number_format($totalQty, 0, ',', '.') ?> pcs
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Penjualan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?= number_format($totalSales, 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Rata-rata per Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?= number_format($totalQty > 0 ? $totalSales / $totalQty : 0, 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Produk Terjual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($salesReport) ?> produk
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Report Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Laporan Penjualan 
                <?= $startDate == date('Y-m-01') && $endDate == date('Y-m-d') ? 'Bulan Ini' : '' ?>
                (<?= date('d M Y', strtotime($startDate)) ?> - <?= date('d M Y', strtotime($endDate)) ?>)
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="salesReportTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th class="text-center">Terjual (pcs)</th>
                            <th class="text-center">% dari Total</th>
                            <th class="text-center">Total Penjualan</th>
                            <th class="text-center">% dari Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($salesReport as $report): ?>
                        <?php 
                        $percentageQty = $totalQty > 0 ? ($report['total_qty'] / $totalQty * 100) : 0;
                        $percentageSales = $totalSales > 0 ? ($report['total_sales'] / $totalSales * 100) : 0;
                        ?>
                        <tr>
                            <td>
                                <strong><?= esc($report['product_name']) ?></strong>
                                <div class="text-muted small">ID: <?= $report['product_id'] ?></div>
                            </td>
                            <td><?= $report['category_name'] ?></td>
                            <td class="text-center">
                                <span class="badge bg-primary"><?= number_format($report['total_qty'], 0, ',', '.') ?></span>
                            </td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-info" role="progressbar" 
                                         style="width: <?= $percentageQty ?>%;" 
                                         aria-valuenow="<?= $percentageQty ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= number_format($percentageQty, 1) ?>%
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <strong class="text-success">Rp <?= number_format($report['total_sales'], 0, ',', '.') ?></strong>
                            </td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: <?= $percentageSales ?>%;" 
                                         aria-valuenow="<?= $percentageSales ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= number_format($percentageSales, 1) ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="2" class="text-end"><strong>TOTAL</strong></th>
                            <th class="text-center">
                                <strong><?= number_format($totalQty, 0, ',', '.') ?> pcs</strong>
                            </th>
                            <th><strong>100%</strong></th>
                            <th class="text-center">
                                <strong class="text-primary">Rp <?= number_format($totalSales, 0, ',', '.') ?></strong>
                            </th>
                            <th><strong>100%</strong></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penjualan per Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Produk Terlaris</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // DataTable
        $('#salesReportTable').DataTable({
            "order": [[2, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });

        // Category Chart
        var categoryCtx = document.getElementById('categoryChart').getContext('2d');
        <?php 
        $categoryData = [];
        $categoryLabels = [];
        foreach($salesReport as $report) {
            if(!isset($categoryData[$report['category_name']])) {
                $categoryData[$report['category_name']] = 0;
            }
            $categoryData[$report['category_name']] += $report['total_sales'];
        }
        ?>
        var categoryChart = new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: [<?= '"'.implode('","', array_keys($categoryData)).'"' ?>],
                datasets: [{
                    data: [<?= implode(',', array_values($categoryData)) ?>],
                    backgroundColor: [
                        '#8a2be2', '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                        '#e74a3b', '#858796', '#5a5c69', '#3a3b45', '#2e2f3e'
                    ],
                    hoverBackgroundColor: [
                        '#7a1fd1', '#3a56c6', '#17a673', '#2aa0b3', '#dda20a',
                        '#d62c1d', '#74757f', '#4a4b55', '#2a2b35', '#1e1f2e'
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });

        // Top Products Chart
        var productsCtx = document.getElementById('topProductsChart').getContext('2d');
        <?php 
        $topProducts = array_slice($salesReport, 0, 5);
        $productLabels = array_column($topProducts, 'product_name');
        $productSales = array_column($topProducts, 'total_sales');
        ?>
        var productsChart = new Chart(productsCtx, {
            type: 'bar',
            data: {
                labels: [<?= '"'.implode('","', $productLabels).'"' ?>],
                datasets: [{
                    label: "Penjualan (Rp)",
                    backgroundColor: "#8a2be2",
                    hoverBackgroundColor: "#7a1fd1",
                    borderColor: "#8a2be2",
                    data: [<?= implode(',', $productSales) ?>],
                }],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>