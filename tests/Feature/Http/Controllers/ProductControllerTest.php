<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
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
        $response->assertViewHas('products', function ($viewProducts) use ($products) {
            return $viewProducts->count() === $products->count();
        });
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
        $price = fake()->numberBetween(100, 10000);
        $category = Category::factory()->create();

        $response = $this->post(route('products.store'), [
            'name' => $name,
            'price' => $price,
            'category_id' => $category->id,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('price', $price)
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $name = fake()->name();
        $price = fake()->numberBetween(100, 10000);
        $category = Category::factory()->create();

        $response = $this->put(route('products.update', $product), [
            'name' => $name,
            'price' => $price,
            'category_id' => $category->id,
        ]);

        $product->refresh();

        $response->assertRedirect(route('products.index'));

        $this->assertEquals($name, $product->name);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($category->id, $product->category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertSoftDeleted($product);
    }
}
