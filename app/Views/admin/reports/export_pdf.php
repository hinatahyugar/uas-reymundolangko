<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        .report-title {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #8a2be2;
            padding-bottom: 15px;
        }
        .report-title h1 {
            color: #8a2be2;
            margin: 0;
            font-size: 24px;
        }
        .report-title p {
            margin: 5px 0 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #8a2be2;
            color: white;
            font-weight: bold;
            padding: 10px;
            text-align: left;
            border: none;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        tr.total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary-box {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .summary-box h4 {
            color: #8a2be2;
            margin: 0 0 10px;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 11px;
            color: #666;
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="report-title">
        <h1>LAPORAN PENJUALAN</h1>
        <p>Beauty Fashion Shop</p>
        <p>Periode: <?= date('d M Y', strtotime($startDate)) ?> - <?= date('d M Y', strtotime($endDate)) ?></p>
        <p>Dibuat pada: <?= date('d M Y H:i:s') ?></p>
    </div>

    <!-- Summary -->
    <div class="summary-box">
        <h4>Ringkasan</h4>
        <table>
            <tr>
                <td width="70%">Total Produk Terjual</td>
                <td class="text-right"><strong><?= $totalQty ?> item</strong></td>
            </tr>
            <tr>
                <td>Total Penjualan</td>
                <td class="text-right"><strong>Rp <?= number_format($totalSales, 0, ',', '.') ?></strong></td>
            </tr>
            <tr>
                <td>Jumlah Produk yang Terjual</td>
                <td class="text-right"><strong><?= count($salesReport) ?> produk</strong></td>
            </tr>
        </table>
    </div>

    <!-- Detail Laporan -->
    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="45%">Nama Produk</th>
                <th width="20%" class="text-center">Jumlah Terjual</th>
                <th width="30%" class="text-right">Total Penjualan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($salesReport as $item): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $item['product_name'] ?></td>
                <td class="text-center"><?= $item['total_qty'] ?></td>
                <td class="text-right"><?= number_format($item['total_sales'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            
            <!-- Total -->
            <tr class="total-row">
                <td colspan="2" class="text-right"><strong>TOTAL</strong></td>
                <td class="text-center"><strong><?= $totalQty ?></strong></td>
                <td class="text-right"><strong>Rp <?= number_format($totalSales, 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem Beauty Fashion Shop</p>
        <p>&copy; <?= date('Y') ?> Beauty Fashion Shop. All rights reserved.</p>
        <p>Halaman 1 dari 1</p>
    </div>
</body>
</html>