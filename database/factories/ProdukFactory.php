<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'sub_kategori_id' => mt_rand(1, 3),
            'nama_produk' => fake()->word(),
            'harga' => fake()->randomNumber(6, true),
            'stok' => fake()->randomDigit(),
            'diskon' => fake()->randomDigit(),
            'deskripsi' => fake()->paragraph,
            'gambar_produk1' => 'https://via.placeholder.com/150',
            'gambar_produk2' => 'https://via.placeholder.com/150',
            'gambar_produk3' => 'https://via.placeholder.com/150',
        ];
    }
}
