    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('points_registers', function (Blueprint $table) {

                $table->id();

                $table->unsignedBigInteger('user_id');
        
                $table->string('table_name')->nullable();
                $table->string('point_table_type')->nullable();
            
                $table->integer('point_table_value')->nullable();

                $table->unsignedBigInteger('point_table_id')->nullable();
            
                $table->timestamps();
            });
            Schema::table('points_registers', function (Blueprint $table) {


                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('point_table_type')->references('type')->on('point_tables')->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('point_table_value')->references('point_value')->on('point_tables')->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('point_table_id')->references('id')->on('point_tables')->onDelete('cascade')->onUpdate('cascade');

            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('points_registers');
        }
    };
