<?php

namespace App\Controllers\Admin;

use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ReportController extends BaseAdminController
{
    protected $cartModel;
    protected $productModel;
    protected $categoryModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);



        $this->cartModel     = new CartModel();
        $this->productModel  = new ProductModel();
        $this->categoryModel = new CategoryModel();

        helper(['number', 'text', 'url']);
    }

    /**
     * Halaman utama laporan
     */
    public function index()
    {
        $startDate  = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate    = $this->request->getGet('end_date') ?? date('Y-m-d');
        $productId  = $this->request->getGet('product_id');
        $categoryId = $this->request->getGet('category_id');

        $salesReport     = $this->cartModel->getSalesReport($startDate, $endDate, $productId);
        $dailySales      = $this->cartModel->getDailySales(date('Y-m-d'));
        $monthlySales    = $this->cartModel->getMonthlySales(date('Y-m'));
        $topProducts     = $this->cartModel->getTopProducts(5);
        $salesByCategory = $this->cartModel->getSalesByCategory();

        $totalQty    = array_sum(array_column($salesReport, 'total_qty'));
        $totalSales  = array_sum(array_column($salesReport, 'total_sales'));

        return view('admin/reports/index', [
            'title'           => 'Laporan Penjualan - Admin',
            'salesReport'     => $salesReport,
            'dailySales'      => $dailySales,
            'monthlySales'    => $monthlySales,
            'topProducts'     => $topProducts,
            'salesByCategory' => $salesByCategory,
            'totalQty'        => $totalQty,
            'totalSales'      => $totalSales,
            'startDate'       => $startDate,
            'endDate'         => $endDate,
            'productId'       => $productId,
            'categoryId'      => $categoryId,
            'products'        => $this->productModel->findAll(),
            'categories'      => $this->categoryModel->findAll()
        ]);
    }

    /**
     * Export laporan ke PDF
     */
    public function exportPdf()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate   = $this->request->getGet('end_date') ?? date('Y-m-d');

        $salesReport = $this->cartModel->getSalesReport($startDate, $endDate);
        $totalQty    = array_sum(array_column($salesReport, 'total_qty'));
        $totalSales  = array_sum(array_column($salesReport, 'total_sales'));

        $html = view('admin/reports/export_pdf', [
            'title'        => 'Laporan Penjualan ' .
                              date('d M Y', strtotime($startDate)) . ' - ' .
                              date('d M Y', strtotime($endDate)),
            'salesReport'  => $salesReport,
            'totalQty'     => $totalQty,
            'totalSales'   => $totalSales,
            'startDate'    => $startDate,
            'endDate'      => $endDate
        ]);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream(
            'laporan-penjualan-' . date('Ymd-His') . '.pdf',
            ['Attachment' => true]
        );
    }

    /**
     * Export laporan ke Excel (CSV)
     */
    public function exportExcel()
    {
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate   = $this->request->getGet('end_date') ?? date('Y-m-d');

        $salesReport = $this->cartModel->getSalesReport($startDate, $endDate);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="laporan-penjualan-' . date('Ymd-His') . '.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['ID Produk', 'Nama Produk', 'Kategori', 'Jumlah Terjual', 'Total Penjualan']);

        foreach ($salesReport as $row) {
            fputcsv($output, [
                $row['product_id'],
                $row['product_name'],
                $row['category_name'],
                $row['total_qty'],
                $row['total_sales']
            ]);
        }

        fputcsv($output, [
            '',
            '',
            'TOTAL',
            array_sum(array_column($salesReport, 'total_qty')),
            array_sum(array_column($salesReport, 'total_sales'))
        ]);

        fclose($output);
        exit;
    }

    /**
     * Chart data (JSON)
     */
    public function chartData()
    {
        $type = $this->request->getGet('type') ?? 'daily';
        $data = [];

        if ($type === 'daily') {
            for ($i = 6; $i >= 0; $i--) {
                $date  = date('Y-m-d', strtotime("-$i days"));
                $sales = $this->cartModel->getDailySales($date);

                $data[] = [
                    'date'   => date('d M', strtotime($date)),
                    'sales'  => $sales ? (float) $sales['total_sales'] : 0,
                    'orders' => $sales ? (int) $sales['total_orders'] : 0
                ];
            }
        } elseif ($type === 'monthly') {
            for ($i = 5; $i >= 0; $i--) {
                $month = date('Y-m', strtotime("-$i months"));
                $sales = $this->cartModel->getMonthlySales($month);

                $data[] = [
                    'month'  => date('M Y', strtotime($month)),
                    'sales'  => $sales ? (float) $sales['total_sales'] : 0,
                    'orders' => $sales ? (int) $sales['total_orders'] : 0
                ];
            }
        } else {
            return $this->response->setJSON(['error' => 'Invalid chart type']);
        }

        return $this->response->setJSON($data);
    }
}
