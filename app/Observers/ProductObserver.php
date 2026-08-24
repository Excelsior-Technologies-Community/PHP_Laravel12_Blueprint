<?php

namespace App\Observers;

use App\Models\Product;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\LogEntry;

class ProductObserver
{
    public function created(Product $product): void
    {
        activity()
            ->causedBy(auth()->id())
            ->withProperties(['product_id' => $product->id, 'name' => $product->name])
            ->log('created');
    }

    public function updated(Product $product): void
    {
        activity()
            ->causedBy(auth()->id())
            ->withProperties(['product_id' => $product->id, 'name' => $product->name])
            ->log('updated');
    }

    public function deleted(Product $product): void
    {
        activity()
            ->causedBy(auth()->id())
            ->withProperties(['product_id' => $product->id, 'name' => $product->name])
            ->log('deleted');
    }

    public function restored(Product $product): void
    {
        activity()
            ->causedBy(auth()->id())
            ->withProperties(['product_id' => $product->id, 'name' => $product->name])
            ->log('restored');
    }
}
