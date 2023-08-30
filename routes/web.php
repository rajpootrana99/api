<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TraderTypeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified', 'role:Admin'])->name('index');

Route::get('/unathorized', function () {
    return view('unathorized');
})->name('unathorized');

Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::get('/fetchUsers', [UserController::class, 'fetchUsers'])->name('user.get');
    Route::get('/approveUser/{user}', [UserController::class, 'approveUser'])->name('user.approve');
    Route::resource('entity', EntityController::class);
    Route::get('/fetchEntities', [EntityController::class, 'fetchEntities'])->name('entity.get');
    Route::get('/fetchSupplierEntities', [EntityController::class, 'fetchSupplierEntities'])->name('supplierEntity.get');
    Route::get('/fetchClientEntities', [EntityController::class, 'fetchClientEntities'])->name('clientEntity.get');
    Route::resource('site', SiteController::class);
    Route::get('/fetchSites', [SiteController::class, 'fetchSites'])->name('site.get');
    Route::resource('tradeType', TraderTypeController::class);
    Route::get('/fetchTradeTypes', [TraderTypeController::class, 'fetchTradeTypes'])->name('tradeType.get');
    Route::resource('task', TaskController::class);
    Route::get('/fetchTasks', [TaskController::class, 'fetchTasks'])->name('task.get');
    Route::get('fetchUserTasks/{user}', [TaskController::class, 'fetchUserTasks']);
    Route::get('/fetchItemGalleries/{item}', [TaskController::class, 'fetchItemGalleries'])->name('itemGallery.get');
    Route::resource('message', MessageController::class);
    Route::get('/fetchPeoples', [MessageController::class, 'fetchPeoples'])->name('people.get');
    Route::get('/fetchMessages/{sender}', [MessageController::class, 'fetchMessages'])->name('message.get');
    Route::get('/fetchTaskMessages/{task}', [MessageController::class, 'fetchTaskMessages']);
    Route::post('/send-message', [MessageController::class, 'sendMessage']);
    Route::resource('notification', NotificationController::class);
    Route::get('/fetchNotifications', [NotificationController::class, 'fetchNotifications'])->name('notification.get');
    Route::resource('contact', ContactController::class);
    Route::get('/fetchContacts', [ContactController::class, 'fetchContacts'])->name('contact.get');
    Route::resource('job', JobController::class);
    Route::get('/fetchJobs', [JobController::class, 'fetchJobs'])->name('job.get');
    Route::resource('enquiry', EnquiryController::class);
    Route::get('/fetchEnquiries', [EnquiryController::class, 'fetchEnquiries'])->name('enquiry.get');
    Route::resource('quote', QuoteController::class);
    Route::get('/fetchQuotes/{task}', [QuoteController::class, 'fetchQuotes'])->name('quote.get');
    Route::resource('site-user', SiteUserController::class);
    Route::get('/fetchSiteUsers', [SiteUserController::class, 'fetchSiteUsers'])->name('site-user.get');
    Route::resource('estimate', EstimateController::class);
    Route::get('/fetchEstimates', [EstimateController::class, 'fetchEstimates'])->name('estimate.get');
    Route::post('addSubHeader', [EstimateController::class, 'addSubHeader'])->name('subheader.post');
    Route::get('/fetchHeaders', [EstimateController::class, 'fetchHeaders'])->name('header.get');
    Route::get('/fetchSubHeaders/{header}', [EstimateController::class, 'fetchSubHeaders'])->name('subheader.get');
    Route::resource('purchaseOrder', PurchaseOrderController::class);
    Route::post('/purchaseOrder/add', [PurchaseOrderController::class, 'add'])->name('purchaseOrder.add');
    Route::get('/fetchPurchaseOrders', [PurchaseOrderController::class, 'fetchPurchaseOrders'])->name('purchaseOrder.get');
});

require __DIR__ . '/auth.php';
