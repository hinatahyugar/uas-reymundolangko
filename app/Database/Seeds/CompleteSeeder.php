<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CompleteSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        // Configuration
        $this->db->table('configuration')->insert([
            'name' => 'Beauty Fashion Kupang',
            'logo' => 'logo.png',
            'address' => 'Jl. Rante Dame 1, Kota Kupang',
            'phone' => '(082) 2661-58487',
            'email' => 'reylangko@info.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Users (Admin + Customers)
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'reylangko@admin.com',
                'password' => password_hash('rey123', PASSWORD_DEFAULT),
                'role' => 'admin', // TAMBAH INI
                'profile_photo_path' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Add 10 customers - TAMBAHKAN ROLE
        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'role' => 'user', // TAMBAH INI
                'profile_photo_path' => null,
                'created_at' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->db->table('users')->insertBatch($users);

        $userDetails = [];
        foreach ($users as $index => $user) {
            $userDetails[] = [
                'user_id' => $index + 1,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->db->table('user_details')->insertBatch($userDetails);

        // Categories
        $categories = [
            ['name' => 'Batik', 'slug' => 'batik'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Accessories', 'slug' => 'accessories'],
            ['name' => 'Shoes', 'slug' => 'shoes'],
            ['name' => 'Bags', 'slug' => 'bags']
        ];

        foreach ($categories as &$cat) {
            $cat['created_at'] = date('Y-m-d H:i:s');
            $cat['updated_at'] = date('Y-m-d H:i:s');
        }
        $this->db->table('categories')->insertBatch($categories);

        // Products
        $products = [];
        $productNames = [
            'Batik Mega Mendung', 'Batik Parang', 'Batik Kawung', 'Batik Sidomukti',
            'Dress Floral', 'Blouse Casual', 'Skirt Plisket', 'Jacket Denim',
            'Necklace Gold', 'Earrings Pearl', 'Bracelet Silver', 'Ring Diamond',
            'Sneakers White', 'Sandals Beach', 'Heels Party', 'Loafers Casual',
            'Handbag Leather', 'Backpack School', 'Clutch Party', 'Tote Bag'
        ];

        foreach ($productNames as $index => $name) {
            $categoryId = ($index % 5) + 1;
            $price = $faker->numberBetween(50000, 500000);
            $discount = $faker->optional(0.3, 0)->numberBetween(5, 50);
            
            $products[] = [
                'title' => $name,
                'slug' => url_title($name, '-', true),
                'category_id' => $categoryId,
                'price' => $price,
                'discount' => $discount,
                'stock' => $faker->numberBetween(0, 100),
                'description' => $faker->paragraph(3),
                'image' => 'product' . (($index % 10) + 1) . '.jpg',
                'type' => $faker->randomElement(['standard', 'headline', 'latest_slider']),
                'shopee_url' => 'https://shopee.co.id/product' . ($index + 1),
                'tokopedia_url' => 'https://tokopedia.com/product' . ($index + 1),
                'lazada_url' => 'https://lazada.co.id/product' . ($index + 1),
                'bukalapak_url' => 'https://bukalapak.com/product' . ($index + 1),
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_at' => $faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->db->table('products')->insertBatch($products);

        // Tags
        $tags = [
            ['title' => 'Batik', 'slug' => 'batik'],
            ['title' => 'Fashion', 'slug' => 'fashion'],
            ['title' => 'Premium', 'slug' => 'premium'],
            ['title' => 'Sale', 'slug' => 'sale'],
            ['title' => 'New', 'slug' => 'new']
        ];

        foreach ($tags as &$tag) {
            $tag['created_at'] = date('Y-m-d H:i:s');
            $tag['updated_at'] = date('Y-m-d H:i:s');
        }
        $this->db->table('tags')->insertBatch($tags);

        // Articles
        $articles = [];
        for ($i = 1; $i <= 15; $i++) {
            $articles[] = [
                'title' => $faker->sentence(6),
                'slug' => url_title($faker->sentence(3), '-', true),
                'content' => $faker->paragraphs(5, true),
                'image' => 'article' . (($i % 5) + 1) . '.jpg',
                'user_id' => 1,
                'category_id' => $faker->numberBetween(1, 3),
                'tag' => $faker->randomElement(['1', '2', '1,2', '3,4', '5']),
                'like_count' => $faker->numberBetween(0, 100),
                'comment_count' => $faker->numberBetween(0, 50),
                'created_at' => $faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->db->table('articles')->insertBatch($articles);

        // Menus
        $menus = [
            // Frontend menus
            ['name' => 'Home', 'slug' => '/', 'parent_id' => 0, 'category_id' => 1, 'type' => '0', 'order' => 1, 'status' => '1'],
            ['name' => 'Products', 'slug' => '#', 'parent_id' => 0, 'category_id' => 1, 'type' => '1', 'order' => 2, 'status' => '1'],
            ['name' => 'Batik', 'slug' => '/categories/batik', 'parent_id' => 2, 'category_id' => 1, 'type' => '0', 'order' => 1, 'status' => '1'],
            ['name' => 'Fashion', 'slug' => '/categories/fashion', 'parent_id' => 2, 'category_id' => 1, 'type' => '0', 'order' => 2, 'status' => '1'],
            ['name' => 'Accessories', 'slug' => '/categories/accessories', 'parent_id' => 2, 'category_id' => 1, 'type' => '0', 'order' => 3, 'status' => '1'],
            ['name' => 'Articles', 'slug' => '/articles', 'parent_id' => 0, 'category_id' => 1, 'type' => '0', 'order' => 3, 'status' => '1'],
            ['name' => 'About', 'slug' => '/about', 'parent_id' => 0, 'category_id' => 1, 'type' => '0', 'order' => 4, 'status' => '1'],
            ['name' => 'Contact', 'slug' => '/contact', 'parent_id' => 0, 'category_id' => 1, 'type' => '0', 'order' => 5, 'status' => '1'],
            
            // Admin menus
            ['name' => 'Dashboard', 'slug' => '/admin/dashboard', 'parent_id' => 0, 'category_id' => 2, 'type' => '0', 'order' => 1, 'status' => '1'],
            ['name' => 'Products', 'slug' => '/admin/products', 'parent_id' => 0, 'category_id' => 2, 'type' => '0', 'order' => 2, 'status' => '1'],
            ['name' => 'Orders', 'slug' => '/admin/orders', 'parent_id' => 0, 'category_id' => 2, 'type' => '0', 'order' => 3, 'status' => '1'],
            ['name' => 'Reports', 'slug' => '/admin/reports', 'parent_id' => 0, 'category_id' => 2, 'type' => '0', 'order' => 4, 'status' => '1'],
        ];

        foreach ($menus as &$menu) {
            $menu['created_at'] = date('Y-m-d H:i:s');
            $menu['updated_at'] = date('Y-m-d H:i:s');
        }
        $this->db->table('menus')->insertBatch($menus);

        // Carts (Orders)
        $carts = [];
        $statuses = ['cart', 'checkout', 'paid', 'shipped', 'completed', 'canceled'];
        $paymentStatuses = ['pending', 'paid', 'failed'];

        for ($i = 1; $i <= 30; $i++) {
            $userId = $faker->numberBetween(2, 11);
            $status = $faker->randomElement($statuses);
            $paymentStatus = $faker->randomElement($paymentStatuses);
            $total = $faker->numberBetween(100000, 2000000);
            
            $carts[] = [
                'user_id' => $userId,
                'no_invoice' => 'INV-' . date('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'status_cart' => $status,
                'status_pembayaran' => $paymentStatus,
                'total' => $total,
                'created_at' => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->db->table('carts')->insertBatch($carts);

        // Cart Details
        $cartDetails = [];
        foreach ($carts as $cartIndex => $cart) {
            $numItems = $faker->numberBetween(1, 5);
            for ($j = 1; $j <= $numItems; $j++) {
                $productId = $faker->numberBetween(1, 20);
                $qty = $faker->numberBetween(1, 3);
                $price = $faker->numberBetween(50000, 500000);
                $subtotal = $qty * $price;
                
                $cartDetails[] = [
                    'cart_id' => $cartIndex + 1,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'harga' => $price,
                    'subtotal' => $subtotal,
                    'created_at' => $cart['created_at'],
                    'updated_at' => $cart['updated_at']
                ];
            }
        }

        $this->db->table('cart_details')->insertBatch($cartDetails);

        // Update cart totals
        $cartTotals = $this->db->table('cart_details')
            ->select('cart_id, SUM(subtotal) as total')
            ->groupBy('cart_id')
            ->get()
            ->getResultArray();

        foreach ($cartTotals as $cartTotal) {
            $this->db->table('carts')
                ->where('id', $cartTotal['cart_id'])
                ->update(['total' => $cartTotal['total']]);
        }

        echo "Seeder berhasil dijalankan!\n";
        echo "Admin Login:\n";
        echo "Email: reylangko@admin.com\n";
        echo "Password: rey123\n";
        echo "\nCustomer Login (contoh):\n";
        echo "Email: " . $users[1]['email'] . "\n";
        echo "Password: user123\n";
    }
}