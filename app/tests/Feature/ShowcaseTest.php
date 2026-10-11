<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ShowcaseTest extends TestCase
{
 use RefreshDatabase;
 public function test_home_displays_catalog_and_consultation_form(): void {
  $this->get('/')->assertOk()->assertSee('Tam Ca Ba Con Mèo')->assertSee('Landing Page Doanh nghiệp')->assertSee('name="phone"',false);
 }
 public function test_all_catalog_demos_are_accessible(): void {
  foreach(config('catalog') as $product) {
   $this->get('/demo/'.$product['slug'])->assertOk()->assertSee($product['headline']);
  }
  $this->get('/demo/unknown')->assertNotFound();
 }
 public function test_valid_inquiry_is_saved(): void {
  $this->post('/tu-van',['name'=>'Khách hàng test','phone'=>'0901234567','email'=>'test@example.com','message'=>'Tư vấn mẫu doanh nghiệp'])
   ->assertRedirect('/#lien-he')->assertSessionHas('success');
  $this->assertDatabaseHas('inquiries',['name'=>'Khách hàng test','phone'=>'0901234567']);
 }
 public function test_invalid_inquiry_is_rejected(): void {
  $this->post('/tu-van',['name'=>'','phone'=>'invalid','email'=>'invalid'])->assertSessionHasErrors(['name','phone','email']);
  $this->assertDatabaseCount('inquiries',0);
 }
 public function test_inquiry_endpoint_is_rate_limited(): void {
  for($i=0;$i<5;$i++) $this->post('/tu-van',['name'=>'Test','phone'=>'0901234567'])->assertRedirect();
  $this->post('/tu-van',['name'=>'Test','phone'=>'0901234567'])->assertStatus(429);
  $this->assertDatabaseCount('inquiries',5);
 }
}
