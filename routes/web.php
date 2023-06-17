<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ReportController2;

Route::get('agent-wise-report',[ReportController::class,'AgentList'])->name('agent-wise-report');
Route::get('agent-daily-report',[ReportController::class,'AgentDailReport'])->name('agent-daily-report');
// Route::get('agent-list',[ReportController::class,'AgentList'])->name('agent-list');
Route::get('agent-total-call/{agent_name}',[ReportController::class,'AgentTotalCall'])->name('agent-total-call');

Route::get('query-results', [QueryController::class,'getResults'])->name('query-result');
Route::get('show-time', [QueryController::class,'showtime'])->name('showtime');


Route::get('agent-list',[ReportController::class,'AgentListCustom'])->name('agent-list');

Route::get('agent-dispostion/{agentName}',[ReportController::class,'AgentDisposition'])->name('aget-dispostion');


// Route::get('query-results2', [ReportController2::class,'getResults'])->name('query-result');
// Route::get('show-time2', [ReportController2::class,'showtime'])->name('showtime');




Route::get('/', function () {
    return view('welcome');
});
