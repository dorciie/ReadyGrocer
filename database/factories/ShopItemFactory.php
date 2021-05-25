<?php

namespace Database\Factories;

use App\Models\ShopItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShopItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'item_name'=>$this->faker->word,
            // 'item_brand'=>$this->faker->word,
            // 'item_price'=>$this->faker->randomFloat(10,2),
            // 'offer_price'=>$this->faker->randomFloat(10,2),
            // 'item_discount'=>$this->faker->randomFloat(10,2),
            // 'item_stock'=>$this->faker->numberBetween(2,10),
            // 'item_image'=>$this->faker->imageUrl(400,200),
            // 'item_description'=>$this->faker->text,
            // 'item_status'=>$this->faker->randomElement(['active','inactive']),
            // 'category_id'=>$this->faker->randomElement(Category::pluck('id')->toArray()),
            // 'shop_id'=>$this->faker->randomElement(ShopOwner::pluck('id')->toArray()),
        ];
    }
}
