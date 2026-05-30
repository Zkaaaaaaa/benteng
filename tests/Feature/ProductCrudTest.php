<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    // ══════════════════════════════════════
    // CATEGORY TESTS
    // ══════════════════════════════════════

    /** @test */
    public function admin_can_view_categories_index()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_create_category()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.categories.store'), [
                'name' => 'Kategori Test',
                'slug' => 'kategori-test',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => 'Kategori Test']);
    }

    /** @test */
    public function admin_can_update_category()
    {
        $category = Category::factory()->create(['name' => 'Lama']);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.categories.update', $category), [
                'name' => 'Baru',
                'slug' => 'baru',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => 'Baru']);
        $this->assertDatabaseMissing('categories', ['name' => 'Lama']);
    }

    /** @test */
    public function admin_can_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect();
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /** @test */
    public function category_name_must_be_unique()
    {
        Category::factory()->create(['name' => 'Duplikat']);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.categories.store'), [
                'name' => 'Duplikat',
                'slug' => 'duplikat',
            ]);

        $response->assertSessionHasErrors('name');
    }

    // ══════════════════════════════════════
    // PRODUCT TESTS
    // ══════════════════════════════════════

    /** @test */
    public function admin_can_view_products_index()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.products.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_create_product()
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), [
                'category_id'    => $category->id,
                'name'           => 'Nasi Goreng Test',
                'price'          => 13.75,
                'description_en' => 'Fried rice',
                'description_nl' => 'Gebakken rijst',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name'  => 'Nasi Goreng Test',
            'price' => 13.75,
        ]);
    }

    /** @test */
    public function admin_can_update_product()
    {
        $category = Category::factory()->create();
        $product  = Product::factory()->create([
            'category_id' => $category->id,
            'name'        => 'Produk Lama',
            'price'       => 10.00,
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.products.update', $product), [
                'category_id' => $category->id,
                'name'        => 'Produk Baru',
                'price'       => 15.00,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['name' => 'Produk Baru', 'price' => 15.00]);
        $this->assertDatabaseMissing('products', ['name' => 'Produk Lama']);
    }

    /** @test */
    public function admin_can_delete_product()
    {
        $category = Category::factory()->create();
        $product  = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.products.destroy', $product));

        $response->assertRedirect();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /** @test */
    public function product_name_must_be_unique_within_same_category()
    {
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id, 'name' => 'Nasi Putih']);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name'        => 'Nasi Putih',
                'price'       => 13.75,
            ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function product_name_can_be_same_in_different_categories()
    {
        $cat1 = Category::factory()->create();
        $cat2 = Category::factory()->create();
        Product::factory()->create(['category_id' => $cat1->id, 'name' => 'Nasi Putih']);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), [
                'category_id' => $cat2->id,
                'name'        => 'Nasi Putih',
                'price'       => 16.75,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseCount('products', 2);
    }

    /** @test */
    public function product_can_be_updated_without_changing_name()
    {
        $category = Category::factory()->create();
        $product  = Product::factory()->create([
            'category_id' => $category->id,
            'name'        => 'Nasi Putih',
            'price'       => 13.75,
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.products.update', $product), [
                'category_id' => $category->id,
                'name'        => 'Nasi Putih',
                'price'       => 15.00,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['name' => 'Nasi Putih', 'price' => 15.00]);
    }

    /** @test */
    public function product_image_is_uploaded_and_stored()
    {
        Storage::fake('public');
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name'        => 'Produk Foto',
                'price'       => 10.00,
                'image'       => UploadedFile::fake()->image('foto.jpg'),
            ]);

        $response->assertRedirect();
        $product = Product::where('name', 'Produk Foto')->first();
        Storage::disk('public')->assertExists($product->image);
    }

    /** @test */
    public function guest_cannot_access_admin_products()
    {
        $response = $this->get(route('admin.products.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_cannot_access_admin_categories()
    {
        $response = $this->get(route('admin.categories.index'));
        $response->assertRedirect(route('login'));
    }
}