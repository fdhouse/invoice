<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date("date");
            $table->integer("type")->comment("1 餐饮 2 视频 3交通");
            $table->decimal("money");
            $table->integer("quantity");
            $table->string("remark");
            $table->integer("has_invoice");
            $table->integer("reimbursed")->default(0);
            $table->text("name");
            $table->timestamp("deleted_at")->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
