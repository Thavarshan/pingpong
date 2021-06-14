<?php

namespace App\Models;

use App\Models\Traits\Addressable;
use Illuminate\Database\Eloquent\Model;
use Emberfuse\Blaze\Models\Traits\Sluggable;
use Emberfuse\Blaze\Models\Traits\Directable;
use Emberfuse\Blaze\Models\Traits\Filterable;
use Emberfuse\Scorch\Models\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use Sluggable;
    use HasFactory;
    use Directable;
    use Filterable;
    use Addressable;
    use HasProfilePhoto;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'company',
        'slug',
        'email',
        'user_id',
        'birthday',
        'profile_photo_path',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'path',
    ];

    /**
     * Get the user this contact belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
