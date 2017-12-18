<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /* Коды статусов заказа в БД */
    const STATUS_NEW      = 0;
    const STATUS_IN_WORK  = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_CANCELED = 3;

    /**
     * Сведение кодов с названиями статусов заказа
     *
     * @var array
     */
    protected $statusNames = [
        self::STATUS_NEW      => 'Новый',
        self::STATUS_IN_WORK  => 'В работе',
        self::STATUS_COMPLETE => 'Завершен',
        self::STATUS_CANCELED => 'Отменен',
    ];

    protected $fillable = [
        'name', 'phone', 'email', 'address', 'product_id'
    ];

    /**
     * Получение названия статуса заказа
     *
     * @return mixed|string
     *
     */
    public function getStatusTitleAttribute()
    {
        return $this->statusNames[$this->status_id] ?? 'Н/Д';
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
