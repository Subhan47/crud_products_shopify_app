<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\ShopifyApp\Contracts\ApiHelper as IApiHelper;
use Osiset\ShopifyApp\Contracts\Objects\Values\AccessToken as AccessTokenValue;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain as ShopDomainValue;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopId as ShopIdValue;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;
use Osiset\ShopifyApp\Objects\Values\SessionContext;
use Osiset\ShopifyApp\Traits\ShopModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements IShopModel
{
    use ShopModel;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function getId(): ShopIdValue
//    {
//        // TODO: Implement getId() method.
//    }
//
//    public function getDomain(): ShopDomainValue
//    {
//        // TODO: Implement getDomain() method.
//    }
//
//    public function getAccessToken(): AccessTokenValue
//    {
//        // TODO: Implement getAccessToken() method.
//    }
//
//    public function charges(): HasMany
//    {
//        // TODO: Implement charges() method.
//    }
//
//    public function plan(): BelongsTo
//    {
//        // TODO: Implement plan() method.
//    }
//
//    public function isGrandfathered(): bool
//    {
//        // TODO: Implement isGrandfathered() method.
//    }
//
//    public function isFreemium(): bool
//    {
//        // TODO: Implement isFreemium() method.
//    }
//
//    public function hasOfflineAccess(): bool
//    {
//        // TODO: Implement hasOfflineAccess() method.
//    }
//
//    public function apiHelper(): IApiHelper
//    {
//        // TODO: Implement apiHelper() method.
//    }
//
//    public function api(): BasicShopifyAPI
//    {
//        // TODO: Implement api() method.
//    }
//
//    public function setSessionContext(SessionContext $session): void
//    {
//        // TODO: Implement setSessionContext() method.
//    }
//
//    public function getSessionContext(): ?SessionContext
//    {
//        // TODO: Implement getSessionContext() method.
//    }
}
