<?php

it('has example page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
