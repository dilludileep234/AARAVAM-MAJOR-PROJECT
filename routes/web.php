<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\AcademicCalendarController as AdminAcademicCalendarController;
use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ResultController as AdminResultController;
use App\Http\Controllers\ResultController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/select-role', function () {
    return view('role-selection');
})->name('role.selection');

Route::get('/student', function () {
    return view('login');
})->name('student'); 

Route::get('/about', function () {
    $galleries = \App\Models\Gallery::all()->groupBy('category');
    return view('about', compact('galleries'));
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Forgot Password & OTP Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot-password.post');
Route::get('/otp', [AuthController::class, 'showOtp'])->name('otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset-password');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset-password');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('reset-password.post');

// New Algorithm and Softskill Pages
Route::get('/algorithm', function () {
    $events = \App\Models\Event::where('category', 'Algorithm')
        ->withCount(['registrationItems as has_results' => function($q) {
            $q->whereNotNull('rank');
        }])->get();
    return view('algorithm', compact('events'));
})->name('algorithm');

Route::get('/elevate', function () {
    $events = \App\Models\Event::where('category', 'softskill')
        ->withCount(['registrationItems as has_results' => function($q) {
            $q->whereNotNull('rank');
        }])->get();
    return view('softskills', compact('events'));
})->name('elevate');


Route::get('/calendar', [AcademicCalendarController::class, 'index'])->name('calendar');

Route::get('/fests', function () {
    return view('fests');
})->name('fests');

Route::get('/cultural', function () {
    $events = \App\Models\Event::where('category', 'Cultural')
        ->withCount(['registrationItems as has_results' => function($q) {
            $q->whereNotNull('rank');
        }])->get();
    return view('cultural', compact('events'));
})->name('cultural');

Route::get('/sports', function () {
    $events = \App\Models\Event::where('category', 'Sports')
        ->withCount(['registrationItems as has_results' => function($q) {
            $q->whereNotNull('rank');
        }])->get();
    return view('sports', compact('events'));
})->name('sports');

Route::get('/arts', function () {
    $events = \App\Models\Event::where('category', 'Arts')
        ->withCount(['registrationItems as has_results' => function($q) {
            $q->whereNotNull('rank');
        }])->get();
    return view('arts', compact('events'));
})->name('arts');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/arts-list', function () {
    return view('arts-list');
})->name('arts.list');

Route::get('/algorithm-list', function () {
    return view('algorithm-list');
})->name('algorithm.list');


Route::get('/cultural-list', function () {
    return view('cultural-list');
})->name('cultural.list');

Route::get('/sports-list', function () {
    return view('sports-list');
})->name('sports.list');

Route::get('/elevate-list', function () {
    $events = \App\Models\Event::where('category', 'softskill')->get();
    return view('elevate-list', compact('events'));
})->name('elevate.list');

Route::get('/results', [ResultController::class, 'index'])->name('results');
Route::get('/results/export', [ResultController::class, 'exportCategory'])->name('results.export');

// Portal Route
Route::middleware(['auth'])->group(function () {
    Route::get('/results/download', [ResultController::class, 'downloadMyResults'])->name('results.download');
    Route::get('/results/item/{item}/export', [ResultController::class, 'exportSingleResult'])->name('results.item.export');
    Route::get('/portal', function () {
        $user = auth()->user();
        $registrations = \App\Models\Registration::where('user_id', $user->id)
            ->with('items.event')
            ->latest()
            ->get();
        
        return view('portal', compact('registrations'));
    })->name('portal');
    
    Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});


// Category Admin Portal Login (Separate from Main Admin)
Route::get('/category', [AdminAuthController::class, 'showCategoryLogin'])->name('category.login');
Route::post('/category/login', [AdminAuthController::class, 'login'])->name('category.login.post');
Route::post('/category/register', [AdminAuthController::class, 'register'])->name('category.register.post');
// Logout utilizes the same logout method but from a /category/logout URL
Route::post('/category/logout', [AdminAuthController::class, 'logout'])->name('category.logout');

// Category Admin Dashboard (Protected, completely separate URL from /admin/...)
Route::middleware('auth:admin')->group(function () {
    Route::get('/category/dashboard', [AdminDashboardController::class, 'categoryIndex'])->name('category.dashboard');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLogin'])->name('admin');
    Route::get('/register', function() { return view('admin-register'); })->name('admin.register');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Admin Forgot Password
    Route::get('/forgot-password', [AdminAuthController::class, 'showForgotPassword'])->name('admin.forgot-password');
    Route::post('/forgot-password', [AdminAuthController::class, 'sendResetLink'])->name('admin.forgot-password.post');
    Route::get('/otp', [AdminAuthController::class, 'showOtp'])->name('admin.otp');
    Route::post('/verify-otp', [AdminAuthController::class, 'verifyOtp'])->name('admin.otp.verify');
    Route::get('/reset-password', [AdminAuthController::class, 'showResetPassword'])->name('admin.reset-password');
    Route::post('/reset-password', [AdminAuthController::class, 'updatePassword'])->name('admin.reset-password.post');

    // Admin Dashboard and Management (Protected Routes)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Events
        Route::resource('events', AdminEventController::class)->names([
            'index' => 'admin.events.index',
            'create' => 'admin.events.create',
            'store' => 'admin.events.store',
            'show' => 'admin.events.show',
            'edit' => 'admin.events.edit',
            'update' => 'admin.events.update',
            'destroy' => 'admin.events.destroy',
        ]);

        // Students
        Route::get('/students/export', [AdminStudentController::class, 'export'])->name('admin.students.export');
        Route::get('/students', [AdminStudentController::class, 'index'])->name('admin.students.index');
        Route::get('/students/{student}', [AdminStudentController::class, 'show'])->name('admin.students.show');
        Route::delete('/students/{student}', [AdminStudentController::class, 'destroy'])->name('admin.students.destroy');
        Route::post('/students/{student}/restore', [AdminStudentController::class, 'restore'])->name('admin.students.restore');
        Route::delete('/students/{student}/force', [AdminStudentController::class, 'forceDelete'])->name('admin.students.force_delete');
        Route::post('/students/{student}/approve', [AdminStudentController::class, 'approve'])->name('admin.students.approve');
        Route::post('/students/{student}/reject', [AdminStudentController::class, 'reject'])->name('admin.students.reject');

        // Registrations
        Route::get('/registrations/export', [AdminRegistrationController::class, 'export'])->name('admin.registrations.export');
        Route::get('/registrations/{registration}/export', [AdminRegistrationController::class, 'exportIndividual'])->name('admin.registrations.exportIndividual');
        Route::get('/registrations', [AdminRegistrationController::class, 'index'])->name('admin.registrations.index');
        Route::patch('/registrations/{registration}/update-status', [AdminRegistrationController::class, 'updateStatus'])->name('admin.registrations.updateStatus');
        
        // Admin Management Routes
        Route::get('/manage-admins', [AdminManagementController::class, 'pendingAdmins'])->name('admin.manage');
        Route::post('/admins/{id}/approve', [AdminManagementController::class, 'approveAdmin'])->name('admin.approve');
        Route::post('/admins/{id}/reject', [AdminManagementController::class, 'rejectAdmin'])->name('admin.reject');
        Route::post('/admins/{id}/restore', [AdminManagementController::class, 'restoreAdmin'])->name('admin.restore');
        Route::delete('/admins/{id}', [AdminManagementController::class, 'deleteAdmin'])->name('admin.delete');

        // Fest Management
        Route::get('/fests', [App\Http\Controllers\Admin\FestManagementController::class, 'index'])->name('admin.fests.index');
        Route::get('/fests/{category}', [App\Http\Controllers\Admin\FestManagementController::class, 'show'])->name('admin.fests.show');

        // Academic Calendar
        Route::get('academic-calendar/settings', [AdminAcademicCalendarController::class, 'settings'])->name('admin.academic-calendar.settings');
        Route::post('academic-calendar/settings', [AdminAcademicCalendarController::class, 'updateSettings'])->name('admin.academic-calendar.settings.update');
        
        Route::resource('academic-calendar', AdminAcademicCalendarController::class)->names([
            'index' => 'admin.academic-calendar.index',
            'create' => 'admin.academic-calendar.create',
            'store' => 'admin.academic-calendar.store',
            'edit' => 'admin.academic-calendar.edit',
            'update' => 'admin.academic-calendar.update',
            'destroy' => 'admin.academic-calendar.destroy',
        ]);

        // Gallery Management
        Route::get('/gallery', [App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('admin.gallery.index');
        Route::post('/gallery', [App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('admin.gallery.store');
        Route::patch('/gallery/{gallery}', [App\Http\Controllers\Admin\GalleryController::class, 'update'])->name('admin.gallery.update');
        Route::delete('/gallery/{gallery}', [App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
        // Result Management
        Route::get('/results', [AdminResultController::class, 'index'])->name('admin.results.index');
        Route::get('/results/{event}/export', [AdminResultController::class, 'export'])->name('admin.results.export');
        Route::get('/results/{event}/edit', [AdminResultController::class, 'edit'])->name('admin.results.edit');
        Route::patch('/results/{event}', [AdminResultController::class, 'update'])->name('admin.results.update');
        Route::delete('/results/{event}', [AdminResultController::class, 'destroy'])->name('admin.results.destroy');
    });
});
