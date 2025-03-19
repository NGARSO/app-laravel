<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotificationController;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $users = User::all();
    $professors = User::where('role', 'professor')->get();

    $professors_tmp = User::withCount('attendances')->where('role', 'professor')->get(); // Assurez-vous que la relation 'attendances' est définie dans le modèle User

    $dataPoints1 = [];
    foreach ($professors_tmp as $candidat) {
        $dataPoints1[] = [
            "label" => $candidat->name,
            "y" => $candidat->attendances_count 
        ];
    }

    $courses_tmp = Course::withCount('room')->get(); 
    $dataPoints2 = [];
    foreach ($courses_tmp as $dep) {
        $dataPoints2[] = [
            "label" => $dep->name, 
            "y" => $dep->students_count 
        ];
    }

    $dataPointsJson1 = json_encode($dataPoints1, JSON_NUMERIC_CHECK); 
    $dataPointsJson2 = json_encode($dataPoints2, JSON_NUMERIC_CHECK);

   // dump($dataPointsJson1, $dataPointsJson2);

    return view('dashboard', compact('users', 'professors', 'dataPointsJson1', 'dataPointsJson2'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/print-courses', function () {
    $courses = Course::all();
    $pdf = Pdf::loadView('pdf.courses', compact('courses'));
    return $pdf->download('courses_list.pdf');
})->name('/print-courses')->middleware(['auth', 'verified']);


Route::get('/print-users', function () {
    $users = User::all();
    $pdf = Pdf::loadView('pdf.users', compact('users'));
    return $pdf->download('users_list.pdf');
})->name('/print-users')->middleware(['auth', 'verified']);

Route::get('/print-attendances', function () {
    $attendances = Attendance::with('professor', 'users')->get(); 
    $pdf = Pdf::loadView('pdf.attendances', compact('attendances'));
    return $pdf->download('attendances_list.pdf');
})->middleware(['auth', 'verified']);

Route::get('/print-classes', function () {
    $classes = Room::All(); 
    $pdf = Pdf::loadView('pdf.classes', compact('classes'));
    return $pdf->download('classes_list.pdf');
})->name('/print-classes')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', ProfileController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('notifications', NotificationController::class);

    

    Route::delete('/users/{user}', [ProfileController::class, 'delete'])->name('users.delete');

});

require __DIR__.'/auth.php';
