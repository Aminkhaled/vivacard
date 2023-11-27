<?php

use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });






// For web routes
Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('send.notification');

// For API routes
Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('api.send.notification');
Route::get('/send-notification/{userId}', function ($userId) {
    $user = \Modules\General\Models\Admin::find($userId);

    if ($user) {
        $user->notify(new TestNotification('testing','testing','5487A7'));
        return 'Notification sent!';
    }

    return 'User not found.';
});
