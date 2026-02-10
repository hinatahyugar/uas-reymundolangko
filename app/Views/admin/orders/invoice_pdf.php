<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice <?= $order['no_invoice'] ?></title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.4;
        }
        .invoice-box {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 8px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 32px;
            color: #333;
            font-weight: bold;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #8a2be2;
            color: white;
            font-weight: bold;
            padding: 12px 8px;
            border: none;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            padding: 12px 8px;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td {
            border-top: 2px solid #8a2be2;
            font-weight: bold;
            padding-top: 12px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .logo {
            max-height: 70px;
        }
        .header {
            border-bottom: 2px solid #8a2be2;
            margin-bottom: 30px;
            padding-bottom: 20px;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-paid { background: #d4edda; color: #155724; }
        .status-pending { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Header -->
        <div class="header">
            <table>
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="<?= base_url('assets/img/logo.png') ?>" class="logo" alt="Logo">
                                    <div style="font-size: 24px; margin-top: 10px;">BEAUTY FASHION SHOP</div>
                                </td>
                                <td>
                                    <strong>Invoice #:</strong> <?= $order['no_invoice'] ?><br>
                                    <strong>Tanggal:</strong> <?= date('d F Y', strtotime($order['created_at'])) ?><br>
                                    <strong>Status:</strong> 
                                    <span class="status-badge status-<?= $order['status_pembayaran'] ?>">
                                        <?= ucfirst($order['status_pembayaran']) ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td style="padding-right: 100px;">
                                    <strong>Dikirim ke:</strong><br>
                                    <?= $order['user_name'] ?><br>
                                    <?= $order['user_email'] ?><br>
                                    <?= $order['phone'] ?? '' ?><br>
                                    <?= $order['address'] ?? '' ?>
                                </td>
                                <td>
                                    <strong>Dari:</strong><br>
                                    <?= $site['name'] ?><br>
                                    <?= $site['address'] ?><br>
                                    <?= $site['phone'] ?? '' ?><br>
                                    <?= $site['email'] ?? '' ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Items -->
        <table>
            <tr class="heading">
                <td width="60%">Item</td>
                <td class="text-right">Harga</td>
                <td class="text-right">Qty</td>
                <td class="text-right">Subtotal</td>
            </tr>
            
            <?php foreach($order['details'] as $item): ?>
            <tr class="item">
                <td><?= $item['title'] ?></td>
                <td class="text-right">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                <td class="text-right"><?= $item['qty'] ?></td>
                <td class="text-right">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>

            <tr class="total">
                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                <td class="text-right">
                    <strong>Rp <?= number_format($order['total'], 0, ',', '.') ?></strong>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah berbelanja di <?= $site['name'] ?></p>
            <p>Invoice ini sah dan diproses oleh sistem.</p>
            <p>&copy; <?= date('Y') ?> <?= $site['name'] ?>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>