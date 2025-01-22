<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Machine;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::factory()->create(['user_type_id' => 2]);
        $this->adminToken = JWTAuth::fromUser($this->adminUser);
    }

    public function testAddMachine(){
        
        $machineData = [
            'location' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'status' => 'active'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->postJson('/api/admin/add_machine', $machineData);

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'machine added successfully',
                    'machine' => $machineData
                ]);
    }

    public function testAddProduct(){

        $productData = [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image_url' => $this->faker->imageUrl
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->postJson('/api/admin/add_product', $productData);

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'product added successfully',
                    'product' => $productData
                ]);
    }

    public function testGetUsers(){

        User::factory()->count(5)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->getJson('/api/admin/users');

        $response->assertStatus(200)
                ->assertJsonCount(6);
    }

    public function testDeleteUser(){
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->deleteJson("/api/admin/users/{$user->id}");

        $response->assertStatus(200)
                ->assertJson(['message' => 'successful']);
    }

    public function testGetTransactions(){
        $transactions = Transaction::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->getJson('/api/admin/transactions');

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    public function testGetProducts(){
        $products = Product::factory()->count(5)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->getJson('/api/admin/products');

        $response->assertStatus(200)
                ->assertJsonCount(5);
    }

    public function testUpdateProduct(){
        $product = Product::factory()->create();
        $updatedData = [
            'name' => $this->faker->word,
            'category' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000), 
            'image_url' => $this->faker->imageUrl(640, 480, 'products', true)
        ];
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->putJson("/api/admin/products/{$product->id}", $updatedData);
    
        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'successful',
                    'data' => [
                        'id' => $product->id,
                        'name' => $updatedData['name'],
                        'category' => $updatedData['category'],
                        'description' => $updatedData['description'],
                        'price' => $updatedData['price'],
                        'image_url' => $updatedData['image_url']
                    ]
                ]);
    }
    

    public function testDeleteProduct(){
        $product = Product::factory()->create();
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->deleteJson("/api/admin/products/{$product->id}");
    
        $response->assertStatus(200)
                ->assertJson(['message' => 'successful']);
    
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function testGetMachines(){
        Machine::factory()->count(3)->create();
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->getJson('/api/admin/machines');
    
        $response->assertStatus(200)
                ->assertJsonCount(3);  
    }

    public function testDeleteMachine(){
        $machine = Machine::factory()->create();
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->deleteJson("/api/admin/machines/{$machine->id}");
    
        $response->assertStatus(200)
                ->assertJson(['message' => 'successful']);
    
        $this->assertDatabaseMissing('machines', ['id' => $machine->id]);
    }

    public function testUpdateMachine(){
        $machine = Machine::factory()->create();
        $updatedData = [
            'location' => $this->faker->streetAddress,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->putJson("/api/admin/machines/{$machine->id}", $updatedData);
    
        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'successful',
                    'data' => $updatedData
                ]);
        
        $this->assertDatabaseHas('machines', $updatedData);
    }

    public function testGetInventory(){
        Inventory::factory()->count(5)->create();
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->getJson('/api/admin/inventory');
    
        $response->assertStatus(200)
                ->assertJsonCount(5); 
    }

    public function testToggleMachineStatus(){
        $machine = Machine::factory()->create(['status' => 'active']);
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->adminToken,
        ])->postJson("/api/admin/machines/toggle_status/{$machine->id}");
    
        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'inactive'  
                ]);
    
        $this->assertEquals('inactive', $machine->fresh()->status);
    }
    
    

}
