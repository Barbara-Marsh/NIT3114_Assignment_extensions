<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /*
     * @test
     *
     */
    public function about_page_returns_200()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    /**
     * @test
     *
     */
    public function home_page_returns_302()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function user_home_page_returns_302()
    {
        $response = $this->get('/user');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function subscription_page_returns_302()
    {
        $response = $this->get('/user/subscription');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function subscription_1_page_returns_302()
    {
        $response = $this->get('/user/subscription/1');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function newsletter_page_returns_302()
    {
        $response = $this->get('/user/newsletter/');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function newsletter_1_page_returns_302()
    {
        $response = $this->get('/user/newsletter/1');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function billing_page_returns_302()
    {
        $response = $this->get('/user/billing');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function billing_1_page_returns_302()
    {
        $response = $this->get('/user/billing/1');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function invoices_page_returns_302()
    {
        $response = $this->get('/user/invoices');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     *
     */
    public function admin_home_returns_302()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function admin_invoice_page_returns_302()
    {
        $response = $this->get('/admin/invoices');
        $response->assertStatus(302);
    }

    /**
     * @test
     *
     */
    public function admin_invoice_creation_page_returns_302()
    {
        $response = $this->get('/admin/invoices/create');
        $response->assertStatus(302);
    }
}
