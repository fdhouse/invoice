<?php

namespace App\Admin\Controllers;

use App\Enum\InvoiceTypeEnum;
use App\Module\Invoice\Entities\Invoice;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InvoiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Module\Invoice\Entities\Invoice';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Invoice);

        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'));
        $grid->column('type', __('Type'));
        $grid->column('money', __('Money'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('remark', __('Remark'));
        $grid->column('has_invoice', __('Has invoice'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $form->number('quantity', __('Quantity'));
        $form->textarea('remark', __('Remark'));
        $form->number('has_invoice', __('Has invoice'));

        return $form;
    }
}
