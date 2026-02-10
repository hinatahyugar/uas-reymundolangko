<?php

namespace App\Controllers\Admin;

use App\Models\CartModel;
use App\Models\ConfigurationModel;

class OrderController extends BaseAdminController
{
    protected $cartModel;
    protected $configModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);


        $this->cartModel  = new CartModel();
        $this->configModel = new ConfigurationModel();

        helper(['number', 'text', 'url']);
    }

    /**
     * Menampilkan semua order
     */
    public function index()
    {
        $orders = $this->cartModel->getWithDetails();

        return view('admin/orders/index', [
            'title'  => 'Data Order - Admin',
            'orders' => $orders
        ]);
    }

    /**
     * Menampilkan detail order
     */
    public function show($id)
    {
        $order = $this->cartModel->getOrderWithDetails($id);
        $site  = $this->configModel->first();

        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Order tidak ditemukan.');
        }

        return view('admin/orders/show', [
            'title' => 'Detail Order - Admin',
            'order' => $order,
            'site'  => $site
        ]);
    }

    /**
     * Update status order
     */
    public function updateStatus($id)
    {
        if (!$this->cartModel->find($id)) {
            return redirect()->back()->with('error', 'Order tidak ditemukan.');
        }

        $this->cartModel->updateStatus(
            $id,
            $this->request->getPost('status')
        );

        return redirect()->back()->with('success', 'Status order berhasil diperbarui.');
    }

    /**
     * Generate PDF Invoice
     */
    public function invoice($id)
    {
        $order = $this->cartModel->getOrderWithDetails($id);
        $site  = $this->configModel->first();

        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Order tidak ditemukan.');
        }

        $html = view('admin/orders/invoice_pdf', [
            'title' => 'Invoice ' . $order['no_invoice'],
            'order' => $order,
            'site'  => $site
        ]);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream(
            'invoice-' . $order['no_invoice'] . '.pdf',
            ['Attachment' => false]
        );
    }

    /**
     * Hapus order
     */
    public function destroy($id)
    {
        if (!$this->cartModel->find($id)) {
            return redirect()->back()->with('error', 'Order tidak ditemukan.');
        }

        $this->cartModel->db
            ->table('cart_details')
            ->where('cart_id', $id)
            ->delete();

        $this->cartModel->delete($id);

        return redirect()->to('/admin/orders')->with('success', 'Order berhasil dihapus.');
    }

    /**
 * Export orders to PDF
 */
public function exportPdf()
{
    $status = $this->request->getGet('status');
    $date = $this->request->getGet('date');
    
    // Get filtered orders
    $orders = $this->cartModel->getFilteredOrders($status, $date);
    
    $html = view('admin/orders/export_pdf', [
        'title' => 'Laporan Order',
        'orders' => $orders,
        'filterStatus' => $status,
        'filterDate' => $date,
        'totalAmount' => array_sum(array_column($orders, 'total'))
    ]);

    // Load DomPDF library
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $filename = 'orders-export-' . date('Y-m-d-His') . '.pdf';
    $dompdf->stream($filename, ['Attachment' => true]);
}

/**
 * Export orders to Excel (CSV)
 */
public function exportExcel()
{
    $status = $this->request->getGet('status');
    $date = $this->request->getGet('date');
    
    // Get filtered orders
    $orders = $this->cartModel->getFilteredOrders($status, $date);
    
    // Set headers for CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="orders-export-' . date('Y-m-d-His') . '.csv"');
    
    $output = fopen('php://output', 'w');
    
    // Add BOM for UTF-8
    fwrite($output, "\xEF\xBB\xBF");
    
    // Header row
    fputcsv($output, [
        'No Invoice',
        'Customer',
        'Email',
        'Phone',
        'Date',
        'Status Order',
        'Status Payment',
        'Total Amount',
        'Address'
    ]);
    
    // Data rows
    foreach ($orders as $order) {
        fputcsv($output, [
            $order['no_invoice'],
            $order['user_name'],
            $order['user_email'],
            $order['phone'] ?? '-',
            date('d M Y H:i', strtotime($order['created_at'])),
            ucfirst($order['status_cart']),
            ucfirst($order['status_pembayaran']),
            'Rp ' . number_format($order['total'], 0, ',', '.'),
            $order['address'] ?? '-'
        ]);
    }
    
    // Total row
    $total = array_sum(array_column($orders, 'total'));
    fputcsv($output, ['', '', '', '', '', '', 'TOTAL:', 'Rp ' . number_format($total, 0, ',', '.')]);
    
    fclose($output);
    exit;
}
}