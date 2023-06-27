<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateModuleTable extends XotBaseMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_low');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                 if (! $this->hasColumn('created_by')) {
                    $table->string('created_by')->nullable();
                 }
                 if (! $this->hasColumn('updated_by')) {
                    $table->string('updated_by')->nullable();
                 }
                 //$table->text('note')->nullable()->change();
            }
        );
    }
};
