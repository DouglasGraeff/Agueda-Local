<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEcommerceTables extends Migration
{

    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('address_id');
            $table->integer('user_id')->unsigned();
            $table->string('address_line1', 255);
            $table->string('address_line2', 255)->nullable();
            $table->string('city', 100);
            $table->string('postal_code', 20);
            $table->string('country', 100);
            $table->boolean('is_default_shipping')->default(false);
            $table->boolean('is_default_billing')->default(false);

            $table->foreign('user_id')->references('user_id')->on('user_info')->onDelete('cascade');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->index('user_id', 'idx_addresses_user_id');
        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('status_id');
            $table->string('status_name', 50)->unique();
        });

        DB::table('order_statuses')->insert([
            ['status_name' => 'Pendente'],
            ['status_name' => 'Processamento'],
            ['status_name' => 'Enviado'],
            ['status_name' => 'Entregue'],
            ['status_name' => 'Cancelado'],
        ]);

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('user_id')->unsigned();
            $table->integer('shipping_address_id')->unsigned();
            $table->integer('billing_address_id')->unsigned();
            $table->timestampTz('created_at')->useCurrent();
            $table->decimal('total_amount', 10, 2);

            $table->foreign('user_id')->references('user_id')->on('user_info')->onDelete('restrict');
            $table->foreign('shipping_address_id')->references('address_id')->on('addresses')->onDelete('restrict');
            $table->foreign('billing_address_id')->references('address_id')->on('addresses')->onDelete('restrict');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id', 'idx_orders_user_id');
        });

        try {
            DB::statement('CREATE INDEX idx_orders_created_at ON orders (created_at DESC)');
        } catch (\Exception $e) {
            Schema::table('orders', function (Blueprint $table) {
                $table->index('created_at', 'idx_orders_created_at');
            });
        }

        Schema::create('order_status_histories', function (Blueprint $table) {
            $table->increments('history_id');
            $table->integer('order_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->timestampTz('timestamp')->useCurrent();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('status_id')->references('status_id')->on('order_statuses')->onDelete('restrict');
        });

        Schema::table('order_status_histories', function (Blueprint $table) {
            $table->index(['order_id', 'timestamp'], 'idx_order_histories_order_status');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity')->unsigned();
            $table->string('sku', 50)->unique()->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestampTz('created_at')->useCurrent();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->decimal('price_at_purchase', 10, 2);

            $table->primary(['order_id', 'product_id']);

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('restrict');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->integer('order_id')->unsigned();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 50);
            $table->string('transaction_status', 50);
            $table->timestampTz('transaction_date')->useCurrent();
            $table->string('transaction_reference', 100)->unique()->nullable();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('restrict');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->index('order_id', 'idx_payments_order_id');
        });

        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('wishlist_id');
            $table->integer('user_id')->unsigned()->unique();
            $table->timestampTz('created_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('user_info')->onDelete('cascade');
        });

        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->increments('wishlist_item_id');
            $table->integer('wishlist_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestampTz('added_at')->useCurrent();

            $table->unique(['wishlist_id', 'product_id']);

            $table->foreign('wishlist_id')->references('wishlist_id')->on('wishlists')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('restrict');
        });

        Schema::table('wishlist_items', function (Blueprint $table) {
            $table->index(['wishlist_id', 'product_id'], 'idx_wishlist_items_list_product');
        });
    }


    public function down()
    {
        Schema::dropIfExists('wishlist_items');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('products');
        Schema::dropIfExists('order_status_histories');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('addresses');
    }
}
