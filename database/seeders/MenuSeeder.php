<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $createCategory = function (string $name) {
            $data = ['name' => $name];
            if (Schema::hasColumn('categories', 'slug')) {
                $data['slug'] = Str::slug($name);
            }
            return Category::firstOrCreate(['name' => $name], $data);
        };

        $coffee    = $createCategory('Coffee');
        $nonCoffee = $createCategory('Non-Coffee');

        $products = [
            // Kategori Coffee (11 produk)
            ['category_id' => $coffee->id, 'name' => 'Kayuhan Signature', 'price' => 18000, 'image' => 'images/foto_menu/kayuhan_signature.jpeg', 'description' => 'Racikan kopi susu signature andalan Kayuhan dengan tekstur creamy dan aroma khas.'],
            ['category_id' => $coffee->id, 'name' => 'Kayuhan Creamy Latte', 'price' => 18000, 'image' => 'images/foto_menu/kayuhan_creamy_latte.jpeg', 'description' => 'Perpaduan espresso house blend dan susu creamy yang lembut di setiap tegukan.'],
            ['category_id' => $coffee->id, 'name' => 'Kopi Susu Gula Aren', 'price' => 17000, 'image' => 'images/foto_menu/kopi_susu_gula_aren.jpeg', 'description' => 'Espresso pilihan berpadu susu segar dan manis legit gula aren asli.'],
            ['category_id' => $coffee->id, 'name' => 'Americano', 'price' => 14000, 'image' => 'images/foto_menu/americano.jpeg', 'description' => 'Ekstraksi biji kopi pilihan dengan karakter rasa bersih dan menyegarkan.'],
            ['category_id' => $coffee->id, 'name' => 'Americano Gula Aren', 'price' => 15000, 'image' => 'images/foto_menu/americano_gula_aren.jpeg', 'description' => 'Kesegaran Americano klasik dengan sentuhan manis alami gula aren.'],
            ['category_id' => $coffee->id, 'name' => 'Coffee Latte', 'price' => 17000, 'image' => 'images/foto_menu/coffee_latte.jpeg', 'description' => 'Keseimbangan espresso lembut dan susu segar steamed.'],
            ['category_id' => $coffee->id, 'name' => 'Coconut Aren Latte', 'price' => 19000, 'image' => 'images/foto_menu/coconut_aren_latte.jpeg', 'description' => 'Kopi susu gula aren dengan aroma kelapa gurih yang menyegarkan.'],
            ['category_id' => $coffee->id, 'name' => 'Pandan Latte', 'price' => 18000, 'image' => 'images/foto_menu/pandan_latte.jpeg', 'description' => 'Kopi susu lembut dengan aroma daun pandan harum yang menenangkan.'],
            ['category_id' => $coffee->id, 'name' => 'Salted Caramel Latte', 'price' => 19000, 'image' => 'images/foto_menu/salted_caramel_latte.jpeg', 'description' => 'Paduan espresso, susu segar, dan saus karamel gurih-manis.'],
            ['category_id' => $coffee->id, 'name' => 'Vanilla Latte', 'price' => 18000, 'image' => 'images/foto_menu/vanilla_latte.jpeg', 'description' => 'Coffee latte klasik dengan sentuhan sirup vanila yang harum.'],
            ['category_id' => $coffee->id, 'name' => 'Mochacino', 'price' => 19000, 'image' => 'images/foto_menu/mochacino.jpeg', 'description' => 'Perpaduan harmonis antara espresso, cokelat pekat, dan susu segar.'],

            // Kategori Non-Coffee (11 produk)
            ['category_id' => $nonCoffee->id, 'name' => 'KTC Matcha', 'price' => 20000, 'image' => 'images/foto_menu/ktc_matcha.jpg', 'description' => 'Racikan spesial matcha premium khas Kayuhan dengan rasa autentik.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Matcha Latte', 'price' => 18000, 'image' => 'images/foto_menu/matcha_latte.jpeg', 'description' => 'Bubuk matcha pilihan berpadu susu segar yang creamy dan seimbang.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Matcha Butterscotch', 'price' => 20000, 'image' => 'images/foto_menu/matcha_butterscoth.jpeg', 'description' => 'Matcha latte lembut dengan manis gurih saus butterscotch.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Matcha Caramel', 'price' => 20000, 'image' => 'images/foto_menu/matcha_caramel.jpeg', 'description' => 'Perpaduan matcha autentik dan saus karamel yang manis legit.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Matcha Strawberry', 'price' => 20000, 'image' => 'images/foto_menu/matcha_strawberry.jpeg', 'description' => 'Kombinasi segar selai stroberi dan creamy matcha latte.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Matcha Vanilla', 'price' => 19000, 'image' => 'images/foto_menu/matcha_vanilla.jpeg', 'description' => 'Matcha latte harum dengan sentuhan rasa vanila lembut.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Chocolate', 'price' => 17000, 'image' => 'images/foto_menu/chocolate.jpeg', 'description' => 'Minuman cokelat klasik pekat dan creamy untuk penyuka manis.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Chocolate Butterscotch', 'price' => 19000, 'image' => 'images/foto_menu/chocolate_butterscoth.jpeg', 'description' => 'Cokelat pekat berpadu saus butterscotch yang kaya rasa.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Chocolate Caramel', 'price' => 19000, 'image' => 'images/foto_menu/chocolate_caramel.jpeg', 'description' => 'Perpaduan cokelat lembut dengan manis karamel pilihan.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Chocolate Vanilla', 'price' => 18000, 'image' => 'images/foto_menu/chocolate_vanilla.jpeg', 'description' => 'Cokelat susu creamy dengan aroma vanila yang lembut.'],
            ['category_id' => $nonCoffee->id, 'name' => 'Alpenliebe Butterscotch', 'price' => 19000, 'image' => 'images/foto_menu/alpenlieble_butterscoth.jpeg', 'description' => 'Minuman creamy manis khas permen karamel butterscotch.'],
        ];

        foreach ($products as $item) {
            Menu::updateOrCreate(
                ['image' => $item['image']],
                $item
            );
        }

        if (Schema::hasTable('team_members')) {
            TeamMember::updateOrCreate(
                ['photo' => 'images/foto_karyawan/owner.jpeg'],
                [
                    'name'  => 'Owner Kayuhan',
                    'role'  => 'Founder & Head Barista',
                    'photo' => 'images/foto_karyawan/owner.jpeg',
                ]
            );
        }
    }
}