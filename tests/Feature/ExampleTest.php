<?php

it('has example page', function () {
    $response = $this->get('/example');

    $response->assertStatus(200);
});
