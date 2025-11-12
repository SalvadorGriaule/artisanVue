<?php

test('create a order', function () {
    $response = $this->postJson('/createOrder', ['row' => ['quantité' => '5', 'product_id' => '1']]);

    $response->assertStatus(200);
});
