<?php

use App\Http\Controllers\CrmController;
use Illuminate\Support\Facades\Route;

Route::get('/leads/import', [CrmController::class, 'showImportPage'])->name('leads.import.show');

Route::get('/leads/import/save', [CrmController::class, 'importLeadsToDb'])->name('leads.import.save');
