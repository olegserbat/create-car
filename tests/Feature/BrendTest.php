<?php

namespace Tests\Feature;

use App\Models\Brend;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrendTest extends TestCase
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
     * Тест: модель имеет заполняемые поля, включая user_id
     */
    public function test_brend_fillable_attributes()
    {
        $brend = new Brend();
        $fillable = $brend->getFillable();

        $this->assertEquals([
            'name',
            'comment',
            'user_id',
        ], $fillable);
    }

    /**
     * Тест: бренд корректно создаётся с user_id текущего пользователя
     */
    public function test_can_create_brend_with_user_id()
    {
        $data = [
            'name' => 'Nike',
            'comment' => 'Спортивная марка',
            'user_id' => $this->user->id,
        ];

        $brend = Brend::create($data);

        $this->assertDatabaseHas('brends', $data);
        $this->assertInstanceOf(Brend::class, $brend);
        $this->assertEquals($this->user->id, $brend->user_id);
    }

    /**
     * Тест: отображение списка брендов (index)
     */
    public function test_can_display_brends_index()
    {
        Brend::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->get('/brends');

        $response->assertStatus(200);
        $response->assertViewIs('brend.index');
        $response->assertViewHas('brends');
        $this->assertCount(3, $response->viewData('brends'));
    }

    /**
     * Тест: отображение формы создания бренда (create)
     */
    public function test_can_display_create_form()
    {
        $response = $this->get('/brends/create');

        $response->assertStatus(200);
        $response->assertViewIs('brend.create');
    }

    /**
     * Тест: успешное создание бренда через контроллер (store)
     */
    public function test_can_store_brend()
    {
        $data = [
            'name' => 'Nike',
            'comment' => 'Спортивная марка',
        ];

        $response = $this->post('/brends', $data);

        $response->assertRedirect('/brends');
        $this->assertDatabaseHas('brends', array_merge($data, ['user_id' => $this->user->id]));
    }

    /**
     * Тест: поле name обязательно при создании
     */
    public function test_name_is_required()
    {
        $response = $this->post('/brends', [
            'name' => '',
            'comment' => 'Test',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Тест: комментарий может быть пустым
     */
    public function test_comment_can_be_null()
    {
        $brend = Brend::create([
            'name' => 'Puma',
            'comment' => null,
            'user_id' => $this->user->id,
        ]);

        $this->assertNull($brend->comment);
        $this->assertDatabaseHas('brends', [
            'name' => 'Puma',
            'comment' => null,
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * Тест: отображение формы редактирования (edit)
     */
    public function test_can_display_edit_form()
    {
        $brend = Brend::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get("/brends/{$brend->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('brend.edit');
    }

    /**
     * Тест: успешное обновление бренда (update)
     */
    public function test_can_update_brend()
    {
        $brend = Brend::factory()->create(['user_id' => $this->user->id]);

        $data = [
            'comment' => 'Обновлённый комментарий',
            'id' => $brend->id,
        ];
        $response = $this->patch("/brends/update", $data);
        $response->assertRedirect('/brends');
        $this->assertDatabaseHas('brends', ['id' => $brend->id, 'comment' => 'Обновлённый комментарий']);
    }

    /**
     * Тест: удаление бренда админом(destroy)
     */
    public function test_can_delete_brend()
    {
        $brend = Brend::factory()->create(['user_id' => $this->user->id]);
        $this->user->name = 'admin';
        $response = $this->delete("/brends/{$brend->id}");
        $response->assertRedirect('/brends');
        $this->assertDatabaseMissing('brends', ['id' => $brend->id]);
    }

    /**
     * Тест: Не возможность удаление бренда если не админ (destroy)
     */
    public function test_cannot_delete_brend()
    {
        $brend = Brend::factory()->create(['user_id' => $this->user->id]);
        $response = $this->delete("/brends/{$brend->id}");
        $this->assertDatabaseHas('brends', ['id' => $brend->id]);
    }

    /**
     * Тест: пользователь может редактировать только свои бренды
     */
    public function test_user_cannot_edit_other_users_brend()
    {
        $otherUser = User::factory()->create();
        $brend = Brend::factory()->create([
            'name' => 'Nike',
            'comment' => 'Спортивный бренд',
            'user_id' => $otherUser->id,
        ]);
        $response = $this->get("/brends/{$brend->id}/edit");
        $response->assertRedirect('/brends');
        $response->assertSessionHas('alert');
        $response->assertDontSee('Редактирование бренда');
    }

    /**
     * Тест: пользователь может удалить только свой бренд
     */
    public function test_user_cannot_delete_other_users_brend()
    {
        $otherUser = User::factory()->create();
        $brend = Brend::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->delete("/brends/{$brend->id}");

        $response->assertForbidden();
        $this->assertDatabaseHas('brends', ['id' => $brend->id]); // запись осталась
    }
}
