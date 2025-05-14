<?php

namespace App\Observers;

use App\Models\Advertisement;
use App\Models\PriceHistory;

class AdvertisementObserver
{
    /**
     * Manipula o evento "updated" do Advertisement.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function updated(Advertisement $advertisement)
    {
        // Verifica se o preço foi alterado
        if ($advertisement->isDirty('price')) {
            // Registra o novo preço no histórico
            PriceHistory::create([
                'advertisement_id' => $advertisement->id,
                'price' => $advertisement->price,
                'register_date' => now(),
            ]);
        }
    }

    /**
     * Manipula o evento "created" do Advertisement.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function created(Advertisement $advertisement)
    {
        // Registra o preço inicial no histórico
        PriceHistory::create([
            'advertisement_id' => $advertisement->id,
            'price' => $advertisement->price,
            'register_date' => now(),
        ]);
    }
}
