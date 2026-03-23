<?php
use VaahCms\Modules\LeadManagement\Http\Controllers\Backend\LeadsController;
/*
 * API url will be: <base-url>/public/api/leadmanagement/leads
 */
Route::group(
    [
        'prefix' => 'leadmanagement/leads',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', [LeadsController::class, 'getAssets'])
        ->name('vh.backend.leadmanagement.api.leads.assets');
    /**
     * Get List
     */
    Route::get('/', [LeadsController::class, 'getList'])
        ->name('vh.backend.leadmanagement.api.leads.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [LeadsController::class, 'updateList'])
        ->name('vh.backend.leadmanagement.api.leads.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [LeadsController::class, 'deleteList'])
        ->name('vh.backend.leadmanagement.api.leads.list.delete');


    /**
     * Create Item
     */
    Route::post('/', [LeadsController::class, 'createItem'])
        ->name('vh.backend.leadmanagement.api.leads.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [LeadsController::class, 'getItem'])
        ->name('vh.backend.leadmanagement.api.leads.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [LeadsController::class, 'updateItem'])
        ->name('vh.backend.leadmanagement.api.leads.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [LeadsController::class, 'deleteItem'])
        ->name('vh.backend.leadmanagement.api.leads.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [LeadsController::class, 'listAction'])
        ->name('vh.backend.leadmanagement.api.leads.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [LeadsController::class, 'itemAction'])
        ->name('vh.backend.leadmanagement.api.leads.item.action');



});
