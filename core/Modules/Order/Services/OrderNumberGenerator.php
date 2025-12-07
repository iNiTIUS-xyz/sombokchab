<?php

namespace Modules\Order\Services;
use Modules\Order\Entities\Order;
use Artisan;
class OrderNumberGenerator{

    public static function makeOrderNumber()
    {
        setEnvValue(['APP_ENV' => 'local']);

        try {
            Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            return null;
        }

        if (class_exists('StaticOptionUpgrade')) {
            try {
                Artisan::call('db:seed', [
                    '--force' => true,
                    '--class' => 'StaticOptionUpgrade'
                ]);
            } catch (\Exception $e) {
                return null;
            }
        }

        setEnvValue(['APP_ENV' => 'production']);

        // Fetch orders that still have no order number
        $orders = Order::whereNull('order_number')->get();

        foreach ($orders as $order) {
            // Use new date-based incremental order number
            $order->order_number = self::generateOrderNumber();
            $order->save();
        }

        update_static_option("make_order_number", 1);
    }


    private static function generateOrderNumber(): string
    {
        $today = now()->format('dmY'); // e.g. 12072025

        $lastOrder = Order::where('order_number', 'LIKE', $today . '%')
            ->orderBy('order_number', 'DESC')
            ->first();

        if ($lastOrder) {
            $lastInc = (int) substr($lastOrder->order_number, -4);
            $newInc  = str_pad($lastInc + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newInc = '0001';
        }

        return $today . $newInc;
    }

}