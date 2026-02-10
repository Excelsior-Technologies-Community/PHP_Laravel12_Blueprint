<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products', $products);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = fake()->name();
        $price = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('products.store'), [
            'name' => $name,
            'price' => $price,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('product.index'));
    }
}
