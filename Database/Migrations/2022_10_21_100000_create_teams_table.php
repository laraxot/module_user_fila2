<?php

<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> cf6505a (.)
=======
use Illuminate\Support\Facades\Schema;
>>>>>>> d9f7748 (up)
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateTeamsTable extends XotBaseMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
<<<<<<< HEAD
                $table->id();
                $table->foreignId('user_id')->index();
                $table->string('name');
                $table->boolean('personal_team');
                $table->timestamps();
<<<<<<< HEAD
            }
        );
=======
            });
>>>>>>> cf6505a (.)

=======
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('name');
            $table->boolean('personal_team');
            $table->timestamps();
        });
    
>>>>>>> d9f7748 (up)
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                // if (! $this->hasColumn('email')) {
                //    $table->string('email')->nullable();
                // }
            }
        );
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> cf6505a (.)
=======
    
>>>>>>> d9f7748 (up)
    }
};
