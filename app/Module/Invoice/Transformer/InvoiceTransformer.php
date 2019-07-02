<?php

namespace App\Transformers;

use App\Module\Invoice\Entities\Invoice;
use Illuminate\Support\Facades\App;
use League\Fractal\TransformerAbstract;

/**
 * Class UsersTransformer.
 *
 * @package namespace App\Transformers;
 */
class InvoiceTransformer extends TransformerAbstract
{
    public function transform(Invoice $invoice)
    {
        return [
            'id'=>$invoice->id,
        ];
    }
}
