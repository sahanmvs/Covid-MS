<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testrecords', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('OrderNo');
            $table->bigInteger('user_id');          
            $table->string('PatientMobile')->nullable();
            $table->string('TestType');
            $table->string('TestTimeSlot');
            $table->string('ReportStaus')->nullable();
            $table->string('FinalReport')->nullable();
            $table->string('ReportUploadedTime')->nullable();
            $table->timestamp('RegistrationDate');
            $table->string('AssignedEmpID')->nullable();
            $table->string('AssignedEmpName')->nullable();
            $table->string('AssignedTime')->nullable();
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
        Schema::dropIfExists('testrecords');
    }
}
