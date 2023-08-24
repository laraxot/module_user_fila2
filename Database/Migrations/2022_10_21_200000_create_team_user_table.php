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

class CreateTeamUserTable extends XotBaseMigration {
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
                $table->foreignId('team_id');
                $table->foreignId('user_id');
                $table->string('role')->nullable();
                $table->timestamps();

                $table->unique(['team_id', 'user_id']);
<<<<<<< HEAD
            }
        );
=======
            });
>>>>>>> cf6505a (.)
=======
            $table->id();
            $table->foreignId('team_id');
            $table->foreignId('user_id');
            $table->string('role')->nullable();
            $table->timestamps();
>>>>>>> d9f7748 (up)

            $table->unique(['team_id', 'user_id']);
        });
    
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                // if (! $this->hasColumn('email')) {
                //    $table->string('email')->nullable();
                // }
            }
        );
    }
};
