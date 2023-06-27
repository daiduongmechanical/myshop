<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Banner
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $banerURL
 * @property string $bannername
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereBanerURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereBannername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 */
	class Banner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bill
 *
 * @property int $billid
 * @property float $amount
 * @property string $type
 * @property int $orderid
 * @property int|null $accountno
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereAccountno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereBillid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereOrderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUpdatedAt($value)
 */
	class Bill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cart
 *
 * @property int $cartid
 * @property int $userid
 * @property int $dishid
 * @property int $quantity
 * @property string|null $required
 * @property int|null $discountid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dishe $dish
 * @property-read \App\Models\User $post
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCartid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDiscountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUserid($value)
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discount
 *
 * @property int $discountid
 * @property string $discountname
 * @property int $discountamount
 * @property string $startdate
 * @property string $enddate
 * @property string $object
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Discountdish> $dishes
 * @property-read int|null $dishes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountamount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereEnddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereObject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereStartdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 */
	class Discount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discountdish
 *
 * @property int $id
 * @property int $discountid
 * @property int $dishid
 * @property string|null $cascade
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Discount $discount
 * @property-read \App\Models\Dishe $dishes
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish whereCascade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish whereDiscountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discountdish whereUpdatedAt($value)
 */
	class Discountdish extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Dishe
 *
 * @property int $dishid
 * @property string $dishname
 * @property float $dishprice
 * @property string $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cart> $carts
 * @property-read int|null $carts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Discountdish> $discountdishes
 * @property-read int|null $discountdishes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dishimage> $dishimages
 * @property-read int|null $dishimages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dishingredient> $ingredients
 * @property-read int|null $ingredients_count
 * @property-read \App\Models\orderdish $orderdish
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rate> $rate
 * @property-read int|null $rate_count
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereDishname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereDishprice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishe withoutTrashed()
 */
	class Dishe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Dishimage
 *
 * @property int $id
 * @property int $dishid
 * @property string $imageurl
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dishe $dish
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage whereImageurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishimage withoutTrashed()
 */
	class Dishimage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Dishingredient
 *
 * @property int $id
 * @property int $dishid
 * @property string $ingredientcode
 * @property int $mass
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dishe $dish
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient whereIngredientcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dishingredient withoutTrashed()
 */
	class Dishingredient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $orderid
 * @property int $userid
 * @property float $totalcost
 * @property string $type
 * @property string $detail
 * @property string $status
 * @property float $feeship
 * @property int $checkout
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\orderdish> $orderDishes
 * @property-read int|null $order_dishes_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCheckout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereFeeship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalcost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserid($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rate
 *
 * @property int $rateid
 * @property int|null $mark
 * @property string|null $comment
 * @property int $userid
 * @property int $dishid
 * @property int $orderid
 * @property string|null $cascade
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dishe $dish
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCascade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereOrderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRateid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUserid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate withoutTrashed()
 */
	class Rate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $google_id
 * @property string|null $facebook_id
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $manage
 * @property string|null $phone
 * @property string $avatar
 * @property string|null $address
 * @property string|null $addresscode
 * @property string|null $dob
 * @property int $block
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $order
 * @property-read int|null $order_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rate> $rate
 * @property-read int|null $rate_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddresscode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereManage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject {}
}

namespace App\Models{
/**
 * App\Models\Warehouseaction
 *
 * @property int $id
 * @property string $ingredientcode
 * @property int $mass
 * @property string $description
 * @property int $userid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction whereIngredientcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouseaction whereUserid($value)
 */
	class Warehouseaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\orderdish
 *
 * @property int $orderdishid
 * @property int $quantity
 * @property int $dishid
 * @property int $orderid
 * @property string|null $require
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $discountid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dishe|null $dish
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish query()
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereDiscountid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereOrderdishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereOrderid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereRequire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|orderdish withoutTrashed()
 */
	class orderdish extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\view
 *
 * @property int $viewid
 * @property int $dishid
 * @property int $userid
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|view newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|view newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|view onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|view query()
 * @method static \Illuminate\Database\Eloquent\Builder|view whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|view whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|view whereDishid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|view whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|view whereUserid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|view whereViewid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|view withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|view withoutTrashed()
 */
	class view extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\warehouse
 *
 * @property string $ingredientcode
 * @property string $name
 * @property int $mass
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse whereIngredientcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|warehouse whereUpdatedAt($value)
 */
	class warehouse extends \Eloquent {}
}

