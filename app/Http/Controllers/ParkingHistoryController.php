<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use App\Models\VehicleEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ParkingHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:Просмотр истории парковок", ["only"=> ["index", "photos", "photosList", "downloadAll"]]);
    }

    public function index()
    {
        $parkingHistory = VehicleEvent::latest('id')->paginate(10);
        foreach ($parkingHistory as $parking) {
            $parking->payment_amount = CurrencyHelper::toSomoni($parking->payment_amount);
            $parking->image_plate_path_in = ltrim($parking->image_plate_path_in, '/');
        }
        return view('parking-history.index', compact('parkingHistory'));
    }

    public function photosList()
    {
        $events = VehicleEvent::latest('id')->paginate(10);
        return view('parking-history.photos-list', compact('events'));
    }

    public function photos($id)
    {
        $event = VehicleEvent::findOrFail($id);

        // теперь сразу формируем ссылки на файлы
        $event->image_full_path_in_url = $event->image_full_path_in ? asset($event->image_full_path_in) : null;
        $event->image_plate_path_in_url = $event->image_plate_path_in ? asset($event->image_plate_path_in) : null;
        $event->image_full_path_out_url = $event->image_full_path_out ? asset($event->image_full_path_out) : null;
        $event->image_plate_path_out_url = $event->image_plate_path_out ? asset($event->image_plate_path_out) : null;

        return view('parking-history.photos', compact('event'));
    }

    // Скачать все фото в ZIP
    public function downloadAll($id)
    {
        $event = VehicleEvent::findOrFail($id);

        $files = [
            $event->image_full_path_in,
            $event->image_plate_path_in,
            $event->image_full_path_out,
            $event->image_plate_path_out,
        ];

        $zipFileName = "photos_{$event->plate_number}_{$event->id}.zip";
        $zipPath = storage_path("app/{$zipFileName}"); // временный ZIP

        $zip = new \ZipArchive;
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($files as $path) {
                if ($path) {
                    // полный путь до файла (например public/uploads/tariffs/xxx.jpg)
                    $fullPath = public_path($path);

                    if (file_exists($fullPath)) {
                        $zip->addFile($fullPath, basename($path));
                    }
                }
            }
            $zip->close();
        }

        if (!file_exists($zipPath)) {
            abort(404, "ZIP файл не был создан");
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
