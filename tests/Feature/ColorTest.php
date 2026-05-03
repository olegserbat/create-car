<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Color;
use App\Models\User;

class ColorTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * Тест: отображение списка цветов (index)
     */
    public function test_can_display_colors_index()
    {
        Color::factory()->count(3)->create();

        $response = $this->get('/colors');

        $response->assertStatus(200);
        $response->assertViewIs('colors.index');
        $response->assertViewHas('colors');
        $this->assertCount(3, $response->viewData('colors'));
    }

    /**
     * Тест: отображение формы создания цвета (create)
     */
    public function test_can_display_create_form()
    {
        $response = $this->get('/colors/create');

        $response->assertStatus(200);
    }

    /**
     * Тест: успешное создание цвета (store)
     */
    public function test_can_store_color()
    {
        $data1 = [
            'name' => 'Черный',
            'price' => "200.00",
            'payment' => 'notFree'
        ];

        $data2 = [
            'name' => 'Черный',
            'price' => 200.00,
            'isFree' => false,
        ];

        $response = $this->post('/colors', $data1);
        $response->assertRedirect('/colors');
        $this->assertDatabaseHas('colors', $data2);
    }

    /**
     * Тест: поле name обязательно при создании
     */
    public function test_name_is_required()
    {
        $response = $this->post('/colors', [
            'name' => '',
            'price' => 0,
            'payment' => 'free'
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Тест: цена может быть 0, и тогда isFree = 1
     */
    public function test_price_can_be_zero_and_is_free_set_correctly()
    {
        $data1 = [
            'name' => 'Черный',
            'price' => "0.00",
            'payment' => 'free'
        ];

        $data2 = [
            'name' => 'Черный',
            'price' => 0.00,
            'isFree' => true,
        ];

        $response = $this->post('/colors', $data1);
        $response->assertRedirect('/colors');
        $this->assertDatabaseHas('colors', $data2);
    }

    /**
     * Тест: отображение формы редактирования (edit)
     */
    public function test_can_display_edit_form()
    {
        $color = Color::factory()->create();

        $response = $this->get("/colors/{$color->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('colors.edit');
    }

    /**
     * Тест: успешное обновление цвета (update)
     */
    public function test_can_update_color()
    {
        $color = Color::factory()->create();

        $data = [
            'price' => '2500.00',
            'id' => $color->id,
        ];
        $response = $this->patch("/colors/update", $data);
        $response->assertRedirect('/colors');
        $this->assertDatabaseHas('colors', array_merge($data, ['id' => $color->id]));
    }
    /**
     * Тест: удаление цвета (destroy)
     */
    public function test_can_delete_color()
    {
        $color = Color::factory()->create();
        $this->user->name = 'admin';

        $response = $this->delete("/colors/{$color->id}");

        $response->assertRedirect('/colors');
        $this->assertDatabaseMissing('colors', ['id' => $color->id]);
    }
}
