<?php

namespace Tests\Feature;

use App\Models\Brend;
use App\Models\Car;
use App\Models\Color;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    public function test_car_has_expected_fillable_attributes(): void
    {
        $this->assertSame([
            'color_id',
            'brend_id',
            'comment',
            'total_price',
            'owner_id',
        ], (new Car)->getFillable());
    }

    public function test_anyone_can_view_cars_index(): void
    {
        $owner = User::factory()->create();
        $car = $this->createCar($owner);

        $response = $this->get(route('cars.index'));

        $response
            ->assertOk()
            ->assertViewIs('cars.index')
            ->assertViewHas('cars', function ($cars) use ($car): bool {
                $viewCar = $cars->firstWhere('id', $car->id);

                return $cars->count() === 1
                    && $viewCar !== null
                    && $viewCar->relationLoaded('brend')
                    && $viewCar->relationLoaded('color')
                    && $viewCar->relationLoaded('owner');
            });
    }

    public function test_anyone_can_view_a_car(): void
    {
        $owner = User::factory()->create();
        $car = $this->createCar($owner, ['comment' => 'Семейный автомобиль']);

        $response = $this->get(route('cars.show', $car));

        $response
            ->assertOk()
            ->assertViewIs('cars.show')
            ->assertViewHas('car', fn (Car $viewCar): bool => $viewCar->is($car))
            ->assertSee('Семейный автомобиль');
    }

    public function test_show_returns_not_found_for_unknown_car(): void
    {
        $this->get('/cars/999999')->assertNotFound();
    }

    public function test_guest_cannot_access_car_management_routes(): void
    {
        $owner = User::factory()->create();
        $car = $this->createCar($owner);

        $this->get(route('cars.create'))->assertRedirect(route('login'));
        $this->post(route('cars.store'), [])->assertRedirect(route('login'));
        $this->get(route('cars.edit', $car))->assertRedirect(route('login'));
        $this->put(route('cars.update', $car), [])->assertRedirect(route('login'));
        $this->delete(route('cars.destroy', $car))->assertRedirect(route('login'));

        $this->assertDatabaseHas('cars', ['id' => $car->id]);
    }

    public function test_authenticated_user_can_view_create_form(): void
    {
        $user = User::factory()->create();
        $color = Color::factory()->create();
        $brend = Brend::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('cars.create'));

        $response
            ->assertOk()
            ->assertViewIs('cars.create')
            ->assertViewHas('colors', fn ($colors): bool => $colors->contains($color))
            ->assertViewHas('brends', fn ($brends): bool => $brends->contains($brend));
    }

    public function test_authenticated_user_can_store_car(): void
    {
        $user = User::factory()->create();
        $color = Color::factory()->create(['price' => 7500.50, 'isFree' => false]);
        $brend = Brend::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('cars.store'), [
            'color_id' => $color->id,
            'brend_id' => $brend->id,
            'total_price' => 125000,
            'comment' => 'Новый автомобиль',
            'owner_id' => User::factory()->create()->id,
        ]);

        $response
            ->assertRedirect(route('cars.index'))
            ->assertSessionHas('success', 'Автомобиль успешно добавлен!');

        $this->assertDatabaseHas('cars', [
            'color_id' => $color->id,
            'brend_id' => $brend->id,
            'comment' => 'Новый автомобиль',
            'total_price' => 132500.5,
            'owner_id' => $user->id,
        ]);
    }

    public function test_store_validates_car_data(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('cars.create'))
            ->post(route('cars.store'), [
                'color_id' => 999999,
                'brend_id' => 999999,
                'total_price' => -1,
                'comment' => str_repeat('a', 65536),
            ]);

        $response
            ->assertRedirect(route('cars.create'))
            ->assertSessionHasErrors(['color_id', 'brend_id', 'total_price', 'comment']);
        $this->assertDatabaseCount('cars', 0);
    }

    public function test_owner_can_view_edit_form(): void
    {
        $owner = User::factory()->create();
        $car = $this->createCar($owner);

        $response = $this->actingAs($owner)->get(route('cars.edit', $car));

        $response
            ->assertOk()
            ->assertViewIs('cars.edit')
            ->assertViewHas('car', fn (Car $viewCar): bool => $viewCar->is($car))
            ->assertViewHasAll(['colors', 'brends']);
    }

    public function test_user_cannot_edit_another_users_car(): void
    {
        $owner = User::factory()->create();
        $anotherUser = User::factory()->create();
        $car = $this->createCar($owner);

        $this->actingAs($anotherUser)
            ->get(route('cars.edit', $car))
            ->assertForbidden();
    }

    public function test_owner_can_update_car(): void
    {
        $owner = User::factory()->create();
        $car = $this->createCar($owner);
        $newColor = Color::factory()->create();
        $newBrend = Brend::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($owner)->put(route('cars.update', $car), [
            'color_id' => $newColor->id,
            'brend_id' => $newBrend->id,
            'total_price' => 250000,
            'comment' => 'Обновлённый автомобиль',
            'owner_id' => User::factory()->create()->id,
        ]);

        $response
            ->assertRedirect(route('cars.index'))
            ->assertSessionHas('success', 'Автомобиль успешно обновлён!');

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'color_id' => $newColor->id,
            'brend_id' => $newBrend->id,
            'total_price' => 250000,
            'comment' => 'Обновлённый автомобиль',
            'owner_id' => $owner->id,
        ]);
    }

    public function test_user_cannot_update_another_users_car(): void
    {
        $owner = User::factory()->create();
        $anotherUser = User::factory()->create();
        $car = $this->createCar($owner, ['comment' => 'Исходный комментарий']);

        $this->actingAs($anotherUser)
            ->put(route('cars.update', $car), [
                'color_id' => $car->color_id,
                'brend_id' => $car->brend_id,
                'total_price' => 1,
                'comment' => 'Чужое изменение',
            ])
            ->assertForbidden();

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'comment' => 'Исходный комментарий',
            'total_price' => $car->total_price,
        ]);
    }

    public function test_update_validates_car_data(): void
    {
        $owner = User::factory()->create();
        $car = $this->createCar($owner);

        $response = $this
            ->actingAs($owner)
            ->from(route('cars.edit', $car))
            ->put(route('cars.update', $car), [
                'color_id' => '',
                'brend_id' => '',
                'total_price' => 'не число',
            ]);

        $response
            ->assertRedirect(route('cars.edit', $car))
            ->assertSessionHasErrors(['color_id', 'brend_id', 'total_price']);
    }

    public function test_owner_can_delete_car(): void
    {
        $owner = User::factory()->create();
        $car = $this->createCar($owner);

        $response = $this->actingAs($owner)->delete(route('cars.destroy', $car));

        $response
            ->assertRedirect(route('cars.index'))
            ->assertSessionHas('success', 'Автомобиль успешно удалён!');
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }

    public function test_user_cannot_delete_another_users_car(): void
    {
        $owner = User::factory()->create();
        $anotherUser = User::factory()->create();
        $car = $this->createCar($owner);

        $this->actingAs($anotherUser)
            ->delete(route('cars.destroy', $car))
            ->assertForbidden();

        $this->assertDatabaseHas('cars', ['id' => $car->id]);
    }

    private function createCar(User $owner, array $attributes = []): Car
    {
        $color = Color::factory()->create();
        $brend = Brend::factory()->create(['user_id' => $owner->id]);

        return Car::create(array_merge([
            'color_id' => $color->id,
            'brend_id' => $brend->id,
            'comment' => 'Тестовый автомобиль',
            'total_price' => 100000,
            'owner_id' => $owner->id,
        ], $attributes));
    }
}
