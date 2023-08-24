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

class CreateTeamInvitationsTable extends XotBaseMigration {
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
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->string('role')->nullable();
            $table->timestamps();

<<<<<<< HEAD
                $table->unique(['team_id', 'email']);
<<<<<<< HEAD
            }
        );
=======
            });
>>>>>>> cf6505a (.)
=======
            $table->unique(['team_id', 'email']);
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
    }

};
