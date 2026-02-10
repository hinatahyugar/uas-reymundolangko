<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #333; }
        .header p { margin: 5px 0; color: #666; }
        .filter-info { margin-bottom: 20px; padding: 10px; background: #f5f5f5; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #8a2be2; color: white; padding: 10px; text-align: left; }
        td { padding: 8px 10px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background: #f9f9f9; }
        .total-row { background: #e8f5e9 !important; font-weight: bold; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; padding-top: 10px; border-top: 1px solid #ddd; text-align: center; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ORDER</h1>
        <p>Beauty Fashion Shop</p>
        <p><?= date('d F Y H:i:s') ?></p>
    </div>
    
    <?php if ($filterStatus || $filterDate): ?>
    <div class="filter-info">
        <strong>Filter:</strong>
        <?php if ($filterStatus): ?>Status: <?= ucfirst($filterStatus) ?><?php endif; ?>
        <?php if ($filterDate): ?><?= $filterStatus ? ' | ' : '' ?>Tanggal: <?= date('d F Y', strtotime($filterDate)) ?><?php endif; ?>
    </div>
    <?php endif; ?>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Customer</th>
                <th>Tanggal</th>
                <th>Status Order</th>
                <th>Status Bayar</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total = 0;
            foreach ($orders as $order): 
                $total += $order['total'];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $order['no_invoice'] ?></td>
                <td><?= esc($order['user_name']) ?><br><small><?= $order['user_email'] ?></small></td>
                <td><?= date('d M Y H:i', strtotime($order['created_at'])) ?></td>
                <td><?= ucfirst($order['status_cart']) ?></td>
                <td><?= ucfirst($order['status_pembayaran']) ?></td>
                <td class="text-right">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="6" class="text-right"><strong>TOTAL:</strong></td>
                <td class="text-right"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: <?= date('d F Y H:i:s') ?></p>
        <p>Beauty Fashion Shop Admin Panel</p>
    </div>
</body>
</html>