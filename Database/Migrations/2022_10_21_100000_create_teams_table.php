<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> cf6505a (.)
use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateTeamsTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
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

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                // if (! $this->hasColumn('email')) {
                //    $table->string('email')->nullable();
                // }
            }
        );
<<<<<<< HEAD
=======

>>>>>>> cf6505a (.)
    }
}
