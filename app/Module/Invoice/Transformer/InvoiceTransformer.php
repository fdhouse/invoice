<?php

namespace App\Module\Invoice\Transformer;

use App\Module\Invoice\Entities\Invoice;
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
