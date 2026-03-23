<?php
use VaahCms\Modules\LeadManagement\Http\Controllers\Backend\TagsController;
/*
 * API url will be: <base-url>/public/api/leadmanagement/tags
 */
Route::group(
    [
        'prefix' => 'leadmanagement/tags',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', [TagsController::class, 'getAssets'])
        ->name('vh.backend.leadmanagement.api.tags.assets');
    /**
     * Get List
     */
    Route::get('/', [TagsController::class, 'getList'])
        ->name('vh.backend.leadmanagement.api.tags.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [TagsController::class, 'updateList'])
        ->name('vh.backend.leadmanagement.api.tags.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [TagsController::class, 'deleteList'])
        ->name('vh.backend.leadmanagement.api.tags.list.delete');


    /**
     * Create Item
     */
    Route::post('/', [TagsController::class, 'createItem'])
        ->name('vh.backend.leadmanagement.api.tags.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [TagsController::class, 'getItem'])
        ->name('vh.backend.leadmanagement.api.tags.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [TagsController::class, 'updateItem'])
        ->name('vh.backend.leadmanagement.api.tags.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [TagsController::class, 'deleteItem'])
        ->name('vh.backend.leadmanagement.api.tags.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [TagsController::class, 'listAction'])
        ->name('vh.backend.leadmanagement.api.tags.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [TagsController::class, 'itemAction'])
        ->name('vh.backend.leadmanagement.api.tags.item.action');



});
