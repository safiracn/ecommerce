<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Sapu & Pengki (category_id: 1)
            ['category_id' => 1, 'name' => 'Sapu Ijuk Premium', 'sku' => 'PRD-SAPU0001', 'price' => 35000, 'stock' => 50, 'description' => 'Sapu ijuk berkualitas tinggi dengan gagang kayu kokoh. Bulu ijuk tebal dan kuat, cocok untuk membersihkan halaman dan teras.', 'is_active' => true],
            ['category_id' => 1, 'name' => 'Sapu Lidi Taman', 'sku' => 'PRD-SAPU0002', 'price' => 28000, 'stock' => 40, 'description' => 'Sapu lidi tradisional untuk membersihkan taman dan halaman. Terbuat dari lidi kelapa pilihan.', 'is_active' => true],
            ['category_id' => 1, 'name' => 'Sapu Plastik Serbaguna', 'sku' => 'PRD-SAPU0003', 'price' => 25000, 'stock' => 60, 'description' => 'Sapu plastik dengan bulu halus, ideal untuk lantai keramik dan marmer.', 'is_active' => true],
            ['category_id' => 1, 'name' => 'Pengki Plastik Besar', 'sku' => 'PRD-SAPU0004', 'price' => 18000, 'stock' => 45, 'description' => 'Pengki plastik ukuran besar dengan pegangan ergonomis.', 'is_active' => true],
            ['category_id' => 1, 'name' => 'Set Sapu dan Pengki Mini', 'sku' => 'PRD-SAPU0005', 'price' => 42000, 'stock' => 8, 'description' => 'Set sapu kecil dan pengki untuk membersihkan meja dan area kecil.', 'is_active' => true],

            // Pel & Alat Pel (category_id: 2)
            ['category_id' => 2, 'name' => 'Spin Mop Deluxe', 'sku' => 'PRD-PEL00001', 'price' => 185000, 'stock' => 25, 'description' => 'Spin mop dengan ember putar otomatis. Kepala mop microfiber mudah dicuci dan diganti.', 'is_active' => true],
            ['category_id' => 2, 'name' => 'Flat Mop Spray', 'sku' => 'PRD-PEL00002', 'price' => 95000, 'stock' => 30, 'description' => 'Flat mop dengan semprotan air built-in. Praktis dan efisien untuk lantai licin.', 'is_active' => true],
            ['category_id' => 2, 'name' => 'Pel Lantai Tongkat', 'sku' => 'PRD-PEL00003', 'price' => 45000, 'stock' => 35, 'description' => 'Pel lantai klasik dengan tongkat aluminium anti karat.', 'is_active' => true],
            ['category_id' => 2, 'name' => 'Refill Kepala Mop Microfiber', 'sku' => 'PRD-PEL00004', 'price' => 25000, 'stock' => 5, 'description' => 'Kepala mop pengganti berbahan microfiber, kompatibel dengan berbagai merek spin mop.', 'is_active' => true],
            ['category_id' => 2, 'name' => 'Ember Pel Putar 360', 'sku' => 'PRD-PEL00005', 'price' => 120000, 'stock' => 20, 'description' => 'Ember pel dengan mekanisme putar 360 derajat. Termasuk 2 kepala mop.', 'is_active' => true],

            // Ember & Baskom (category_id: 3)
            ['category_id' => 3, 'name' => 'Ember Plastik 20 Liter', 'sku' => 'PRD-EMBR0001', 'price' => 32000, 'stock' => 55, 'description' => 'Ember plastik tebal berkapasitas 20 liter dengan pegangan kuat.', 'is_active' => true],
            ['category_id' => 3, 'name' => 'Ember Plastik 10 Liter', 'sku' => 'PRD-EMBR0002', 'price' => 22000, 'stock' => 60, 'description' => 'Ember plastik 10 liter, ringan dan mudah dibawa.', 'is_active' => true],
            ['category_id' => 3, 'name' => 'Baskom Plastik Besar', 'sku' => 'PRD-EMBR0003', 'price' => 28000, 'stock' => 40, 'description' => 'Baskom plastik besar untuk mencuci dan merendam pakaian.', 'is_active' => true],
            ['category_id' => 3, 'name' => 'Ember Tutup Serbaguna', 'sku' => 'PRD-EMBR0004', 'price' => 45000, 'stock' => 30, 'description' => 'Ember dengan tutup rapat untuk penyimpanan air dan bahan makanan.', 'is_active' => true],
            ['category_id' => 3, 'name' => 'Set Baskom Susun 5 Pcs', 'sku' => 'PRD-EMBR0005', 'price' => 75000, 'stock' => 7, 'description' => 'Set baskom susun isi 5 ukuran berbeda. Hemat tempat penyimpanan.', 'is_active' => true],

            // Rak & Lemari (category_id: 4)
            ['category_id' => 4, 'name' => 'Rak Serbaguna 4 Tingkat', 'sku' => 'PRD-RAK00001', 'price' => 250000, 'stock' => 15, 'description' => 'Rak serbaguna 4 tingkat dari bahan plastik PP premium. Kuat menahan beban hingga 20kg per tingkat.', 'is_active' => true],
            ['category_id' => 4, 'name' => 'Rak Sepatu 5 Susun', 'sku' => 'PRD-RAK00002', 'price' => 175000, 'stock' => 20, 'description' => 'Rak sepatu 5 susun dengan cover kain anti debu. Muat hingga 15 pasang sepatu.', 'is_active' => true],
            ['category_id' => 4, 'name' => 'Rak Dapur Stainless 3 Tingkat', 'sku' => 'PRD-RAK00003', 'price' => 320000, 'stock' => 12, 'description' => 'Rak dapur stainless steel anti karat 3 tingkat. Cocok untuk menyimpan bumbu dan peralatan dapur.', 'is_active' => true],
            ['category_id' => 4, 'name' => 'Rak Dinding Minimalis', 'sku' => 'PRD-RAK00004', 'price' => 85000, 'stock' => 25, 'description' => 'Rak dinding floating shelf minimalis. Material kayu MDF dengan finishing rapi.', 'is_active' => true],
            ['category_id' => 4, 'name' => 'Lemari Plastik 4 Laci', 'sku' => 'PRD-RAK00005', 'price' => 280000, 'stock' => 9, 'description' => 'Lemari plastik 4 laci untuk pakaian dan perlengkapan. Warna modern dan tahan lama.', 'is_active' => true],

            // Tempat Sampah (category_id: 5)
            ['category_id' => 5, 'name' => 'Tempat Sampah Injak 10L', 'sku' => 'PRD-SMPH0001', 'price' => 65000, 'stock' => 35, 'description' => 'Tempat sampah injak 10 liter dengan inner bucket yang mudah dilepas.', 'is_active' => true],
            ['category_id' => 5, 'name' => 'Tempat Sampah Tutup Ayun 25L', 'sku' => 'PRD-SMPH0002', 'price' => 55000, 'stock' => 30, 'description' => 'Tempat sampah besar 25 liter dengan tutup ayun. Cocok untuk dapur.', 'is_active' => true],
            ['category_id' => 5, 'name' => 'Tempat Sampah Sensor Otomatis', 'sku' => 'PRD-SMPH0003', 'price' => 350000, 'stock' => 10, 'description' => 'Tempat sampah sensor infrared otomatis. Tutup terbuka otomatis saat mendeteksi gerakan.', 'is_active' => true],
            ['category_id' => 5, 'name' => 'Tempat Sampah Pilah 2 Kompartemen', 'sku' => 'PRD-SMPH0004', 'price' => 120000, 'stock' => 18, 'description' => 'Tempat sampah 2 kompartemen untuk memilah sampah organik dan anorganik.', 'is_active' => true],
            ['category_id' => 5, 'name' => 'Tempat Sampah Mini Desktop', 'sku' => 'PRD-SMPH0005', 'price' => 25000, 'stock' => 50, 'description' => 'Tempat sampah kecil untuk meja kerja. Desain minimalis dan kompak.', 'is_active' => true],

            // Alat Dapur (category_id: 6)
            ['category_id' => 6, 'name' => 'Set Spatula Silikon 5 Pcs', 'sku' => 'PRD-DAPR0001', 'price' => 89000, 'stock' => 25, 'description' => 'Set spatula silikon food grade 5 pcs. Tahan panas hingga 230°C.', 'is_active' => true],
            ['category_id' => 6, 'name' => 'Talenan Bambu Premium', 'sku' => 'PRD-DAPR0002', 'price' => 75000, 'stock' => 30, 'description' => 'Talenan bambu alami ukuran besar. Anti bakteri dan ramah lingkungan.', 'is_active' => true],
            ['category_id' => 6, 'name' => 'Rak Piring Stainless Steel', 'sku' => 'PRD-DAPR0003', 'price' => 145000, 'stock' => 20, 'description' => 'Rak piring stainless steel 2 tingkat dengan baki penampung air.', 'is_active' => true],
            ['category_id' => 6, 'name' => 'Dispenser Sabun Cuci Piring', 'sku' => 'PRD-DAPR0004', 'price' => 35000, 'stock' => 40, 'description' => 'Dispenser sabun dengan sponge holder. Pompa tekan mudah digunakan.', 'is_active' => true],
            ['category_id' => 6, 'name' => 'Set Toples Kaca 3 Pcs', 'sku' => 'PRD-DAPR0005', 'price' => 110000, 'stock' => 6, 'description' => 'Set toples kaca kedap udara 3 ukuran. Cocok untuk menyimpan bumbu dan makanan kering.', 'is_active' => true],

            // Kotak Penyimpanan (category_id: 7)
            ['category_id' => 7, 'name' => 'Container Box 50 Liter', 'sku' => 'PRD-BOX00001', 'price' => 95000, 'stock' => 20, 'description' => 'Container box 50 liter dengan tutup rapat dan roda. Ideal untuk penyimpanan pakaian.', 'is_active' => true],
            ['category_id' => 7, 'name' => 'Storage Box Lipat 30L', 'sku' => 'PRD-BOX00002', 'price' => 68000, 'stock' => 25, 'description' => 'Box penyimpanan lipat 30 liter. Dapat dilipat saat tidak digunakan.', 'is_active' => true],
            ['category_id' => 7, 'name' => 'Organizer Laci 8 Sekat', 'sku' => 'PRD-BOX00003', 'price' => 45000, 'stock' => 35, 'description' => 'Organizer laci dengan 8 sekat untuk merapikan aksesoris dan perlengkapan kecil.', 'is_active' => true],
            ['category_id' => 7, 'name' => 'Keranjang Rotan Sintetis', 'sku' => 'PRD-BOX00004', 'price' => 55000, 'stock' => 28, 'description' => 'Keranjang penyimpanan anyaman rotan sintetis. Tampilan elegan untuk dekorasi rumah.', 'is_active' => true],
            ['category_id' => 7, 'name' => 'Vacuum Bag Pakaian Set 6 Pcs', 'sku' => 'PRD-BOX00005', 'price' => 78000, 'stock' => 3, 'description' => 'Vacuum bag untuk pakaian isi 6 pcs berbagai ukuran. Hemat ruang penyimpanan hingga 75%.', 'is_active' => true],

            // Keset & Alas (category_id: 8)
            ['category_id' => 8, 'name' => 'Keset Karet Anti Slip', 'sku' => 'PRD-KSET0001', 'price' => 45000, 'stock' => 40, 'description' => 'Keset karet anti slip untuk kamar mandi. Permukaan pijat kaki yang nyaman.', 'is_active' => true],
            ['category_id' => 8, 'name' => 'Keset Coir Welcome', 'sku' => 'PRD-KSET0002', 'price' => 65000, 'stock' => 30, 'description' => 'Keset serabut kelapa dengan tulisan Welcome. Natural dan tahan lama.', 'is_active' => true],
            ['category_id' => 8, 'name' => 'Keset Microfiber Super Soft', 'sku' => 'PRD-KSET0003', 'price' => 55000, 'stock' => 35, 'description' => 'Keset microfiber super lembut dengan daya serap air tinggi. Nyaman untuk kaki telanjang.', 'is_active' => true],
            ['category_id' => 8, 'name' => 'Alas Meja Makan PVC Set 6', 'sku' => 'PRD-KSET0004', 'price' => 85000, 'stock' => 22, 'description' => 'Set alas meja makan PVC 6 pcs. Tahan panas, mudah dibersihkan.', 'is_active' => true],
            ['category_id' => 8, 'name' => 'Keset Dapur Panjang Anti Lelah', 'sku' => 'PRD-KSET0005', 'price' => 125000, 'stock' => 4, 'description' => 'Keset dapur panjang dengan bantalan anti lelah. Ukuran 120x45cm.', 'is_active' => true],

            // Gantungan & Jemuran (category_id: 9)
            ['category_id' => 9, 'name' => 'Hanger Kayu Set 10 Pcs', 'sku' => 'PRD-GNTG0001', 'price' => 95000, 'stock' => 30, 'description' => 'Hanger kayu natural set 10 pcs dengan anti-slip bar. Cocok untuk kemeja dan jas.', 'is_active' => true],
            ['category_id' => 9, 'name' => 'Jemuran Lipat Aluminium', 'sku' => 'PRD-GNTG0002', 'price' => 225000, 'stock' => 15, 'description' => 'Jemuran lipat aluminium anti karat. Mudah dilipat dan disimpan.', 'is_active' => true],
            ['category_id' => 9, 'name' => 'Gantungan Pintu Stainless 6 Hook', 'sku' => 'PRD-GNTG0003', 'price' => 45000, 'stock' => 40, 'description' => 'Gantungan pintu stainless steel 6 hook. Tanpa bor, mudah dipasang.', 'is_active' => true],
            ['category_id' => 9, 'name' => 'Hanger Plastik Warna Set 20 Pcs', 'sku' => 'PRD-GNTG0004', 'price' => 55000, 'stock' => 45, 'description' => 'Set hanger plastik warna-warni 20 pcs. Ringan dan tidak mudah patah.', 'is_active' => true],
            ['category_id' => 9, 'name' => 'Jemuran Handuk Dinding 4 Bar', 'sku' => 'PRD-GNTG0005', 'price' => 85000, 'stock' => 2, 'description' => 'Jemuran handuk dinding stainless 4 bar. Hemat ruang kamar mandi.', 'is_active' => true],

            // Peralatan Kebersihan (category_id: 10)
            ['category_id' => 10, 'name' => 'Sikat Toilet dengan Holder', 'sku' => 'PRD-BRSH0001', 'price' => 38000, 'stock' => 35, 'description' => 'Sikat toilet dengan holder higienis. Bulu sikat tahan lama dan efektif membersihkan.', 'is_active' => true],
            ['category_id' => 10, 'name' => 'Lap Microfiber Set 5 Pcs', 'sku' => 'PRD-BRSH0002', 'price' => 42000, 'stock' => 50, 'description' => 'Set lap microfiber 5 pcs berbagai warna. Daya serap tinggi, tidak meninggalkan serat.', 'is_active' => true],
            ['category_id' => 10, 'name' => 'Spons Cuci Piring Set 10 Pcs', 'sku' => 'PRD-BRSH0003', 'price' => 18000, 'stock' => 70, 'description' => 'Set spons cuci piring 10 pcs dengan sisi kasar dan halus.', 'is_active' => true],
            ['category_id' => 10, 'name' => 'Sarung Tangan Karet Tebal', 'sku' => 'PRD-BRSH0004', 'price' => 22000, 'stock' => 45, 'description' => 'Sarung tangan karet tebal untuk mencuci dan membersihkan. Tahan bahan kimia.', 'is_active' => true],
            ['category_id' => 10, 'name' => 'Sikat Lantai Gagang Panjang', 'sku' => 'PRD-BRSH0005', 'price' => 48000, 'stock' => 28, 'description' => 'Sikat lantai dengan gagang panjang aluminium. Bulu sikat keras untuk noda membandel.', 'is_active' => true],
        ];

        foreach ($products as $product) {
            $product['slug'] = \Illuminate\Support\Str::slug($product['name']);
            Product::create($product);
        }
    }
}
