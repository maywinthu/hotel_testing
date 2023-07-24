<?php

use App\Http\Controllers\AboutUsApiController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BannerApiController;
use App\Http\Controllers\BillApiController;
use App\Http\Controllers\BookingApiController;
use App\Http\Controllers\CommentApiController;
use App\Http\Controllers\ContactApiController;
use App\Http\Controllers\GuestApiController;
use App\Http\Controllers\HotelApiContoller;
use App\Http\Controllers\LikeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeApiController;
use App\Http\Controllers\PhotoApiController;
use App\Http\Controllers\PostApiCokntroller;
use App\Http\Controllers\RoomApiController;
use App\Http\Controllers\StaffApiController;
use App\Http\Controllers\StaffPaymentApiController;
use App\Http\Controllers\StaffRoleApiController;
use App\Http\Controllers\Testimonial;
use App\Http\Controllers\TestimonialApiController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\StaffPayment;
use App\Models\Testimonial as ModelsTestimonial;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("v1")->group( function() {

});

Route::post("/register",[ApiAuthController::class,'register'])->name('api.register');
Route::post("/login",[ApiAuthController::class,'login'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post("/logout",[ApiAuthController::class,'logout'])->name('api.logout');
    Route::post("/logout-all",[ApiAuthController::class,'logoutAll'])->name('api.logout-all');

    Route::apiResource('posts',PostApiCokntroller::class);
    Route::apiResource('comments',CommentApiController::class);
    
    Route::post("/posts/comments",[CommentApiController::class,'comments'])->name('api.comments');
    Route::post("/posts/like",[LikeApiController::class,'like'])->name('api.like');

    Route::apiResource('testimonials',TestimonialApiController::class);

    Route::apiResource('roomtypes',RoomTypeApiController::class);

    Route::apiResource('photos',PhotoApiController::class);

    Route::apiResource('rooms',RoomApiController::class);

    Route::apiResource('hotels',HotelApiContoller::class);

    Route::apiResource('guests',GuestApiController::class);

    Route::apiResource('bookings',BookingApiController::class);

    Route::apiResource('staffroles',StaffRoleApiController::class);

    Route::apiResource('staffs',StaffApiController::class);

    Route::apiResource('staffpayments',StaffPaymentApiController::class);

    Route::apiResource('bills',BillApiController::class);

    Route::apiResource('aboutus',AboutUsApiController::class);

    Route::apiResource('banners',BannerApiController::class);

    Route::apiResource('send-email',ContactApiController::class);

    Route::apiResource('likes',LikeApiController::class);
});


