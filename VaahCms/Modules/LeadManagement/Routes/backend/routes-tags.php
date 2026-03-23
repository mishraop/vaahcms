<?php

use VaahCms\Modules\LeadManagement\Http\Controllers\Backend\TagsController;

Route::group(
    [
        'prefix' => 'backend/leadmanagement/tags',
        
        'middleware' => ['web', 'has.backend.access'],
        
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', [TagsController::class, 'getAssets'])
        ->name('vh.backend.leadmanagement.tags.assets');
    /**
     * Get List
     */
    Route::get('/', [TagsController::class, 'getList'])
        ->name('vh.backend.leadmanagement.tags.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [TagsController::class, 'updateList'])
        ->name('vh.backend.leadmanagement.tags.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [TagsController::class, 'deleteList'])
        ->name('vh.backend.leadmanagement.tags.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', [TagsController::class, 'fillItem'])
        ->name('vh.backend.leadmanagement.tags.fill');

    /**
     * Create Item
     */
    Route::post('/', [TagsController::class, 'createItem'])
        ->name('vh.backend.leadmanagement.tags.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [TagsController::class, 'getItem'])
        ->name('vh.backend.leadmanagement.tags.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [TagsController::class, 'updateItem'])
        ->name('vh.backend.leadmanagement.tags.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [TagsController::class, 'deleteItem'])
        ->name('vh.backend.leadmanagement.tags.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [TagsController::class, 'listAction'])
        ->name('vh.backend.leadmanagement.tags.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [TagsController::class, 'itemAction'])
        ->name('vh.backend.leadmanagement.tags.item.action');

    //---------------------------------------------------------

});
