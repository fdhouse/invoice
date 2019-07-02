<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\exports\InvoiceExport;
use App\Admin\Extensions\Tools\ReimbursedTool;
use App\Enum\HasInvoiceEnum;
use App\Enum\InvoiceTypeEnum;
use App\Enum\ReimbursedEnum;
use App\Module\Invoice\Entities\Invoice;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class InvoiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Invoice';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Invoice);
        $grid->model()->orderBy("reimbursed", "DESC")->orderBy("date", "ASC");

        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'));
        $grid->column('type', __('Type'))->display(function($type){
            return InvoiceTypeEnum::getInvoiceType($type);
        });
        $grid->column('money', "Money")->totalRow();
        $grid->column('quantity', __('Quantity'));
        $grid->column('remark', __('Remark'));
        $grid->column('has_invoice', __('Has invoice'))->display(function($hasInvoice){
            return HasInvoiceEnum::getHasInvoiceEnum($hasInvoice);
        });
        $grid->reimbursed('reimbursed')->display(function($reimbursed){
            return ReimbursedEnum::getReimbursedEnum($reimbursed);
        });
        $grid->name("name");
        $grid->column('created_at', __('Created at'));

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->between("date", "Date")->date();
            $filter->equal("name", "Name");
            $filter->equal("type", "Type")->select(InvoiceTypeEnum::getInvoiceType());
            $filter->equal("reimbursed", "reimbursed")->select(ReimbursedEnum::getReimbursedEnum());
            $filter->equal("has_invoice", "has invoice")->select(HasInvoiceEnum::getHasInvoiceEnum());
        });

        $grid->tools(function($tools){
            $tools->batch(function($batch){
                $batch->add("all reimbursed", new ReimbursedTool());
            });
        });

        $grid->exporter(new InvoiceExport());

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Invoice::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('date', __('Date'));
        $show->field('type', __('Type'));
        $show->field('money', __('Money'));
        $show->field('quantity', __('Quantity'));
        $show->field('remark', __('Remark'));
        $show->field('has_invoice', __('Has invoice'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Invoice);

        $form->date('date', __('Date'))->default(date('Y-m-d'));
        $form->select('type', __('Type'))->options(InvoiceTypeEnum::getInvoiceType())->default(InvoiceTypeEnum::DINING);
        $form->decimal('money', __('Money'));
        $form->number('quantity', __('Quantity'))->default(1);
        $form->textarea('remark', __('Remark'))->default("食品");

        $hasInvoiceStates = [
            'on' => ['value'=> 1, 'text' => 'YES'],
            'off'=> ['value'=>2, 'text' => 'NO']
        ];
        $form->switch('has_invoice', __('Has invoice'))->states($hasInvoiceStates)->default(HasInvoiceEnum::YES);
        $reimbursedStates = [
            'on' => ['value'=> 1, 'text' => 'YES'],
            'off'=> ['value'=>2, 'text' => 'NO']
        ];
        $form->switch("reimbursed")->states($reimbursedStates)->default(ReimbursedEnum::NO);
        $form->text("name")->placeholder("reimbursement applicant name")->default("潘飞");
        return $form;
    }

    public function reimbursed(Request $request)
    {
        foreach (Invoice::find($request->get('ids')) as $invoice) {
            $invoice->reimbursed = 1;
            $invoice->save();
        }
    }
}
