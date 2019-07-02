<?php


namespace App\Module\Invoice\Service;

use App\Module\Invoice\Entities\Invoice;

class InvoiceService
{
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
        $array = $this->invoice->all();

        return $array;
    }

}