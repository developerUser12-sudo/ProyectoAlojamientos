<?php

namespace App\Console;

use App\Models\Habitacion;
use App\Models\HabitacionesReservadas;
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
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $ayer = now()->subDay()->toDateString();

            $reservasPasadasCoches = CocheReservado::where('fecha_devolucion', $ayer)->get();
            foreach ($reservasPasadasCoches as $reserva) {
                Coche::where('id', $reserva->id_coche)->increment('disponibles');
            }

            $reservasPasadasHoteles = HabitacionesReservadas::where('fecha_salida', $ayer)->get();
            foreach ($reservasPasadasHoteles as $reserva) {
                Habitacion::where('id', $reserva->habitacion_id)->increment('disponibles');
            }
        })->dailyAt('00:05');

    }

}
