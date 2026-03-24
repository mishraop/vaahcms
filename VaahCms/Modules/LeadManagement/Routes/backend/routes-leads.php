<?php

use VaahCms\Modules\LeadManagement\Http\Controllers\Backend\LeadsController;

Route::group(
    [
        'prefix' => 'backend/leadmanagement/leads',
        
        'middleware' => ['web', 'has.backend.access'],
        
],
function () {
    Route::get('/users', [LeadsController::class, 'searchUser'])
                ->name('vh.backend.leadmanagement.leads.assets');

    Route::get('/tags', [LeadsController::class, 'searchTags'])
                ->name('vh.backend.leadmanagement.leads.assets');
    /**
     * Get Assets
     */
    Route::get('/assets', [LeadsController::class, 'getAssets'])
        ->name('vh.backend.leadmanagement.leads.assets');
    /**
     * Get List
     */
    Route::get('/', [LeadsController::class, 'getList'])
        ->name('vh.backend.leadmanagement.leads.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [LeadsController::class, 'updateList'])
        ->name('vh.backend.leadmanagement.leads.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [LeadsController::class, 'deleteList'])
        ->name('vh.backend.leadmanagement.leads.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', [LeadsController::class, 'fillItem'])
        ->name('vh.backend.leadmanagement.leads.fill');

    /**
     * Create Item
     */
    Route::post('/', [LeadsController::class, 'createItem'])
        ->name('vh.backend.leadmanagement.leads.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [LeadsController::class, 'getItem'])
        ->name('vh.backend.leadmanagement.leads.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [LeadsController::class, 'updateItem'])
        ->name('vh.backend.leadmanagement.leads.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [LeadsController::class, 'deleteItem'])
        ->name('vh.backend.leadmanagement.leads.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [LeadsController::class, 'listAction'])
        ->name('vh.backend.leadmanagement.leads.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [LeadsController::class, 'itemAction'])
        ->name('vh.backend.leadmanagement.leads.item.action');

    //---------------------------------------------------------

});
