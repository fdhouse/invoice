<?php


namespace App\Admin\Extensions\exports;


use Encore\Admin\Grid\Exporters\ExcelExporter;

class InvoiceExport extends ExcelExporter
{
    protected $fileName = "对账日志.xlsx";

    protected $columns = [
        'Date' => "日期",
        'Type' => "类型",
        'Money' => "金额",
        'Remark' => "备注",
        'name' => "付款人"
    ];

}