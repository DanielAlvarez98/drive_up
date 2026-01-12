<?php
date_default_timezone_set("America/Lima");

use Carbon\Carbon;
use App\Models\user\Car;
use App\Models\User\Document;
use App\Models\User\Maintenance;

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}


if (!function_exists('userNotifications')) {
    function userNotifications()
    {
        if (!auth()->check()) {
            return [
                'items' => [],
                'expired' => 0,
                'warning' => 0,
                'total' => 0
            ];
        }

        $today = Carbon::today();
        $limit = $today->copy()->addDays(10);

        $expired = 0;
        $warning = 0;
        $items = [];

        $cars = auth()->user()->cars()
            ->with(['documents', 'maintenances'])
            ->get();

        foreach ($cars as $car) {
            foreach ($car->documents as $doc) {
                if (!$doc->fecRenov) continue;

                $fec = Carbon::parse($doc->fecRenov);

                if ($fec->isPast()) {
                    $expired++;
                    $items[] = [
                        'type' => 'danger',
                        'icon' => 'bi-file-excel',
                        'urgencia' => 'Urgente',
                        'title' => $doc->name,
                        'text' => 'Vencido hace',
                        'days' => $fec->diffInDays($today),
                        'car' => "{$car->marca} - {$car->placa}",
                        'car-fecha' => "{$doc->fecRenov}"

                    ];
                } elseif ($fec->lte($limit)) {
                    $warning++;
                    $items[] = [
                        'type' => 'warning',
                        'icon' => 'bi-exclamation-triangle',
                        'urgencia' => 'Media',
                        'title' => $doc->name,
                        'text' => 'Vence en',
                        'days' => $today->diffInDays($fec),
                        'car' => "{$car->marca} - {$car->placa}",
                        'car-fecha' => "{$doc->fecRenov}"

                    ];
                }
            }

            foreach ($car->maintenances as $mnt) {
                if (!$mnt->fecRenov) continue;

                $fec = Carbon::parse($mnt->fecRenov);

                if ($fec->isPast()) {
                    $expired++;
                    $items[] = [
                        'type' => 'danger',
                        'icon' => 'bi-file-excel',
                        'urgencia' => 'Urgente',
                        'title' => $mnt->name,
                        'text' => 'Vencido hace',
                        'days' => $fec->diffInDays($today),
                        'car' => "{$car->marca} - {$car->placa}",
                        'car-fecha' => "{$mnt->fecRenov}"

                    ];
                } elseif ($fec->lte($limit)) {
                    $warning++;
                    $items[] = [
                        'type' => 'warning',
                        'icon' => 'bi-exclamation-triangle',
                        'urgencia' => 'Media',
                        'title' => $mnt->name,
                        'text' => 'Vence en',
                        'days' => $today->diffInDays($fec),
                        'car' => "{$car->marca} - {$car->placa}",
                        'car-fecha' => "{$mnt->fecRenov}"
                    ];
                }
            }
        }

        return [
            'items' => $items,
            'expired' => $expired,
            'warning' => $warning,
            'total' => $expired + $warning
        ];
    }
}

if (!function_exists('user_car_stats')) {
    function user_car_stats()
    {
        $user = auth()->user();
        if (!$user) return null;

        $today = Carbon::today();
        $startMonth = $today->copy()->startOfMonth();

        $totalCars = $user->cars()->count();
        $carsThisMonth = $user->cars()
            ->where('created_at', '>=', $startMonth)
            ->count();

        return [
            'total' => $totalCars,
            'this_month' => $carsThisMonth,
        ];
    }
}


if (!function_exists('user_document_stats')) {
    function user_document_stats()
    {
        $user = auth()->user();
        if (!$user) return null;

        $today = Carbon::today();
        $limit = $today->copy()->addDays(10);

        $documents = Document::where('user_id', $user->id)
            ->whereNotNull('fecRenov')
            ->get();

        $active = 0;
        $warning = 0;

        foreach ($documents as $doc) {
            $fec = Carbon::parse($doc->fecRenov);

            if ($fec->gte($today)) {
                $active++;
            }

            if ($fec->between($today, $limit)) {
                $warning++;
            }
        }

        return [
            'active' => $active,
            'warning' => $warning,
            'total' => $documents->count(),
        ];
    }
}
if (!function_exists('user_maintenance_stats')) {
    function user_maintenance_stats()
    {
        $user = auth()->user();
        if (!$user) return null;

        $maintenances = Maintenance::where('user_id', $user->id)->get();

        return [
            'total' => $maintenances->count(),
            'total_price' => $maintenances->sum('price'),
        ];
    }
}
if (!function_exists('user_week_alerts')) {
    function user_week_alerts()
    {
        $user = auth()->user();
        if (!$user) return null;

        $today = Carbon::today();
        $startMonth = $today->copy()->startOfMonth();
        $endMonth   = $today->copy()->endOfMonth();
        $endWeek    = $today->copy()->addDays(7);

        $documentsMonth = Document::where('user_id', $user->id)
            ->whereBetween('fecRenov', [$startMonth, $endMonth])
            ->get();

        $maintenancesMonth = Maintenance::where('user_id', $user->id)
            ->whereBetween('fecRenov', [$startMonth, $endMonth])
            ->get();

        $totalMonth = $documentsMonth->count() + $maintenancesMonth->count();

        $weekCount =
            $documentsMonth->filter(
                fn($d) =>
                Carbon::parse($d->fecRenov)->between($today, $endWeek)
            )->count()
            +
            $maintenancesMonth->filter(
                fn($m) =>
                Carbon::parse($m->fecRenov)->between($today, $endWeek)
            )->count();

        return [
            'total_month' => $totalMonth,
            'total_week'  => $weekCount,
        ];
    }
}
