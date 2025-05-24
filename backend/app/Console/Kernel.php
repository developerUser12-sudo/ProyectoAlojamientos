<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use \App\Models\CocheReservado;
use \App\Models\Coche;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
   

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $reservasPasadas = CocheReservado::where('fecha_devolucion', '<', now())->get();
        foreach ($reservasPasadas as $reserva) {
            Coche::where('id', $reserva->id_coche)->increment('disponibles');
        }
        CocheReservado::where('fecha_devolucion', '<', now())->delete();
    })->everyFiveMinutes();
}

}
    