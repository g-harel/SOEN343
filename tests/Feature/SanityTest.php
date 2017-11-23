<?php

// TODO user pages
// TODO admin pages

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SanityTest extends TestCase {
    public function testHome() {
        $this->get('/')->assertStatus(200);
    }

    public function testLogin() {
        $this->get('/login')->assertStatus(200);
    }

    public function testLogout() {
        $this->get('/logout')->assertStatus(200);
    }

    public function testRegister() {
        $this->get('/register')->assertStatus(200);
    }

    public function testView() {
        $this->get('/view')->assertStatus(200);
    }

    public function testMonitor() {
        $this->get('/view/monitor')->assertStatus(200);
    }

    public function testDesktop() {
        $this->get('/view/desktop')->assertStatus(200);
    }

    public function testLaptop() {
        $this->get('/view/laptop')->assertStatus(200);
    }

    public function testTablet() {
        $this->get('/view/tablet')->assertStatus(200);
    }
}
