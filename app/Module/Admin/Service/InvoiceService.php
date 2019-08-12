<?php


namespace App\Module\Invoice\Service;

use App\Module\Invoice\Entities\Invoice;
use App\Module\Invoice\Transformer\InvoiceTransformer;
use App\util\DataUtil;
use Dingo\Api\Routing\Helpers;

class InvoiceService
{
    use Helpers;
    public $invoice;

    function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get news data with paginate
     */
    public function invoiceList()
    {
        $array = $this->invoice->paginate();

        return DataUtil::processDataCollectionPaginate($array, new InvoiceTransformer());

        //return $array;
    }

}