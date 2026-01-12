<?php

namespace App\Jobs;

use App\Models\User\Document;
use App\Models\User\Maintenance;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpirationNotificationMail;

date_default_timezone_set("America/Lima");

class SendExpirationNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */ public function handle()
    {
        $today = Carbon::today();
        $limit = $today->copy()->addDays(10);

        Document::with('user')
            ->whereNotNull('fecRenov')->whereHas('user')
            ->get()
            ->each(function ($doc) use ($today, $limit) {

                $date = Carbon::parse($doc->fecRenov);
                $user = $doc->user;

                if ($date->lt($today) && !$doc->notified_expired) {

                    Mail::to($user->email)
                        ->queue(new ExpirationNotificationMail(
                            $user,
                            $doc,
                            'expired',
                            'Documento'
                        ));

                    $doc->update(['notified_expired' => true]);
                }

                if ($date->between($today, $limit) && !$doc->notified_warning) {

                    Mail::to($user->email)
                        ->queue(new ExpirationNotificationMail(
                            $user,
                            $doc,
                            'warning',
                            'Documento'
                        ));

                    $doc->update(['notified_warning' => true]);
                }
            });

        Maintenance::with('user')
            ->whereNotNull('fecRenov')
            ->get()
            ->each(function ($mnt) use ($today, $limit) {

                $date = Carbon::parse($mnt->fecRenov);
                $user = $mnt->user;

                if ($date->lt($today) && !$mnt->notified_expired) {

                    Mail::to($user->email)
                        ->queue(new ExpirationNotificationMail(
                            $user,
                            $mnt,
                            'expired',
                            'Mantenimiento'
                        ));

                    $mnt->update(['notified_expired' => true]);
                }

                if ($date->between($today, $limit) && !$mnt->notified_warning) {

                    Mail::to($user->email)
                        ->queue(new ExpirationNotificationMail(
                            $user,
                            $mnt,
                            'warning',
                            'Mantenimiento'
                        ));

                    $mnt->update(['notified_warning' => true]);
                }
            });
    }
}
