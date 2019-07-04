<?php


namespace App\Http\Controllers\api\invoice;

use App\Http\Controllers\api\BaseController;
use App\Module\Invoice\Service\InvoiceService;
use App\Module\Invoice\Transformer\InvoiceTransformer;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Resource;
use Symfony\Component\VarDumper\VarDumper;

/**
 * invoice manage
 *
 * @Resource("Invoice", uri = "/invoice")
 *
 * @package App\Http\Controllers\api\invoice
 */
class InvoiceController extends BaseController
{
    private $invoiceService;

    function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * @OA\Get(
     *     path = "/",
     *     tags = {"invoice"},
     *     summary = "get invoice info",
     *     operationId="invoice",
     *     @OA\RequestBody(
     *          description="request body",
     *          @OA\JsonContent(ref="#/components/schemas/invoicePto")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/invoiceVo")
     *     )
     * )
     */
    public function getInvoices()
    {
        $data = $this->invoiceService->invoiceList();
        VarDumper::dump($data);

        return $data;
    }

}