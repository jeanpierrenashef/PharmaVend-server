<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Machine;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductsControllerTest extends TestCase{
    use RefreshDatabase, WithFaker;

    public function testGetProductList(){

        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $machine = Machine::factory()->create();
        $product = Product::factory()->create();
        $inventory = Inventory::factory()->create([
            'machine_id' => $machine->id,
            'product_id' => $product->id,
            'quantity' => 5
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson("/api/{$machine->id}");

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'machine_id',
                    'products' => [],
                    'inventory' => []
                ]);
    }

    public function testPurchaseProduct(){

        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $machine = Machine::factory()->create();
        $product = Product::factory()->create(['price' => 10.00]);
        $inventory = Inventory::factory()->create([
            'machine_id' => $machine->id,
            'product_id' => $product->id,
            'quantity' => 10
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/purchase', [
            'machine_id' => $machine->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Purchase successful',
                'remaining_quantity' => 9,
                'product' => [
                    'machine_id' => $machine->id,
                    'product_id' => $product->id,
                    'quantity' => 9,
                    'created_at' => null,
                    'updated_at' => null
                ]
            ]);
    
    }
    public function testGetHistoryOfPurchase(){

        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        Transaction::factory()->create(['user_id' => $user->id]);


        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/history'); 

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'transactions' => [
                        '*' => [
                            'id',
                            'user_id',
                            'machine_id',
                            'product_id',
                            'quantity',
                            'total_price',
                            'dispensed',
                            'created_at',
                            'updated_at',
                        ]
                    ]
                ]);
        }


    public function testDispenseTransaction(){

        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $transaction = Transaction::factory()->create(['user_id' => $user->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->putJson("/api/dispense/{$transaction->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'transaction' => [
                        'dispensed' => 1,
                        'id' => $transaction->id
                    ]
                ]);
    }

    public function testGetProduct(){

        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson("/api/product/{$product->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'product' => [
                        'id' => $product->id
                    ]
                ]);
    }

}
