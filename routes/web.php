<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\FileExplorerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TraderTypeController;
use App\Http\Controllers\vendor\Chatify\MessagesController;
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

Route::middleware(['auth', 'verified', 'role:Admin|Client|Supplier'])->group(function () {

    // EXPLORER ROUTES
    Route::resource('explorer', FileExplorerController::class);
    Route::post('/getFileFolders', [FileExplorerController::class, "getFileFolders"])->name("explorer.get");
    Route::get('/download/{file}', [FileExplorerController::class, 'download'])->name('explorer.download');
    Route::post('/delete', [FileExplorerController::class, 'deleteFileFolder'])->name('explorer.delete');
    Route::post('/edit', [FileExplorerController::class, 'getEditData'])->name('explorer.getEditData');
    Route::get('/tree/{path?}', [FileExplorerController::class, 'getFolderTree'])->name('explorer.getFolderTree');
    Route::post('/save', [FileExplorerController::class, 'saveEditedData'])->name('explorer.saveEditedData');
    Route::post('/create', [FileExplorerController::class, 'createFolder'])->name('explorer.createFolder');
    Route::get('/getUploadFolderInfo/{file}', [FileExplorerController::class, 'getUploadFolderInfo'])->name('explorer.getUploadFolderInfo');
    Route::post('/upload', [FileExplorerController::class, 'uploadFiles'])->name('explorer.uploadFiles');

    // USER ROUTES
    Route::resource('user', UserController::class);
    Route::get('/fetchUsers', [UserController::class, 'fetchUsers'])->name('user.get');
    Route::get('/approveUser/{user}', [UserController::class, 'approveUser'])->name('user.approve');

    // ENTITY ROUTES
    Route::resource('entity', EntityController::class);
    Route::get('/fetchEntities', [EntityController::class, 'fetchEntities'])->name('entity.get');
    Route::post('/addTradeType', [EntityController::class, 'addTradeType'])->name('entity.addTradeType');
    Route::post('/removeTradeType', [EntityController::class, 'removeTradeType'])->name('entity.removeTradeType');
    Route::get('/fetchSupplierEntities', [EntityController::class, 'fetchSupplierEntities'])->name('supplierEntity.get');
    Route::get('/fetchClientEntities', [EntityController::class, 'fetchClientEntities'])->name('clientEntity.get');

    // SITE ROUTES
    Route::resource('site', SiteController::class);
    Route::get('/fetchSites', [SiteController::class, 'fetchSites'])->name('site.get');

    // TRADE TYPE ROUTES
    Route::resource('tradeType', TraderTypeController::class);
    Route::get('/fetchTradeTypes', [TraderTypeController::class, 'fetchTradeTypes'])->name('tradeType.get');

    // TASK ROUTES
    Route::resource('task', TaskController::class);
    Route::get('/fetchTasks', [TaskController::class, 'fetchTasks'])->name('task.get');
    Route::get('fetchUserTasks/{user}', [TaskController::class, 'fetchUserTasks']);
    Route::get('/fetchItemGalleries/{item}', [TaskController::class, 'fetchItemGalleries'])->name('itemGallery.get');

    // MESSAGE ROUTES
    Route::resource('message', MessageController::class);
    Route::get('/fetchPeoples', [MessageController::class, 'fetchPeoples'])->name('people.get');
    Route::get('/fetchMessages/{sender}', [MessageController::class, 'fetchMessages'])->name('message.get');
    Route::get('/fetchTaskMessages/{task}', [MessageController::class, 'fetchTaskMessages']);
    Route::post('/send-message', [MessageController::class, 'sendMessage']);


    Route::get('/getTasks', [MessagesController::class, 'getTasks']);
    Route::get('/getUnseenTaskMessages', [MessagesController::class, 'unseenTaskMessages']);


    // NOTIFICATION ROUTES
    Route::resource('notification', NotificationController::class);
    Route::get('/fetchNotifications', [NotificationController::class, 'fetchNotifications'])->name('notification.get');

    // CONTACT ROUTES
    Route::resource('contact', ContactController::class);
    Route::get('/fetchContacts', [ContactController::class, 'fetchContacts'])->name('contact.get');

    // JOB ROUTES
    Route::resource('job', JobController::class);
    Route::get('/fetchJobs', [JobController::class, 'fetchJobs'])->name('job.get');
    Route::get('/convertToJob/{task}', [JobController::class, 'convertToJob'])->name('convertJob.get');
    Route::get('/editInvoice/{task}', [QuoteController::class, 'editInvoice'])->name('invoice.edit');

    // ENQUIRY ROUTES
    Route::resource('enquiry', EnquiryController::class);
    Route::get('/fetchEnquiries', [EnquiryController::class, 'fetchEnquiries'])->name('enquiry.get');
    Route::get('/convertToEnquiry/{task}', [EnquiryController::class, 'convertToEnquiry'])->name('convertEnquiry.get');

    // QUOTE ROUTES
    Route::resource('quote', QuoteController::class);
    Route::get('/fetchQuotes/{task}', [QuoteController::class, 'fetchQuotes']);
    Route::get('/captureSaving/{task}', [QuoteController::class, 'captureSaving'])->name('captureSaving.get');

    // SITE USER ROUTES
    Route::resource('site-user', SiteUserController::class);
    Route::get('/fetchSiteUsers', [SiteUserController::class, 'fetchSiteUsers'])->name('site-user.get');

    // ESTIMATE ROUTES
    Route::resource('estimate', EstimateController::class);
    Route::get('/fetchEstimates', [EstimateController::class, 'fetchEstimates'])->name('estimate.get');
    Route::post('addSubHeader', [EstimateController::class, 'addSubHeader'])->name('subheader.post');
    Route::get('/fetchHeaders', [EstimateController::class, 'fetchHeaders'])->name('header.get');
    Route::get('/fetchSubHeaders/{header}', [EstimateController::class, 'fetchSubHeaders'])->name('subheader.get');


    //PURCHASE ORDER ROUTES
    Route::resource('purchaseOrder', PurchaseOrderController::class);
    Route::post('/purchaseOrder/add', [PurchaseOrderController::class, 'add'])->name('purchaseOrder.add');
    Route::get('/fetchPurchaseOrders', [PurchaseOrderController::class, 'fetchPurchaseOrders'])->name('purchaseOrder.get');

    // INVOICE ROUTES
    Route::resource('invoice', InvoiceController::class);
    Route::get('/fetchInvoices', [InvoiceController::class, 'fetchInvoices'])->name('invoice.get');

    //NOTE ROUTES
    Route::resource('note',  NoteController::class);
    Route::get('/fetchNotes', [NoteController::class, 'fetchNotes'])->name('note.get');

    //Email Send
    Route::get('/sendEmail/{invoice}', [InvoiceController::class, 'sendEmail'])->name('invoice.sendEmail');
});

require __DIR__ . '/auth.php';
