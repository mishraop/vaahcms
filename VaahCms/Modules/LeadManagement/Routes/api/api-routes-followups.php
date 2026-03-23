<?php
use VaahCms\Modules\LeadManagement\Http\Controllers\Backend\FollowupsController;
/*
 * API url will be: <base-url>/public/api/leadmanagement/followups
 */
Route::group(
    [
        'prefix' => 'leadmanagement/followups',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', [FollowupsController::class, 'getAssets'])
        ->name('vh.backend.leadmanagement.api.followups.assets');
    /**
     * Get List
     */
    Route::get('/', [FollowupsController::class, 'getList'])
        ->name('vh.backend.leadmanagement.api.followups.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [FollowupsController::class, 'updateList'])
        ->name('vh.backend.leadmanagement.api.followups.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [FollowupsController::class, 'deleteList'])
        ->name('vh.backend.leadmanagement.api.followups.list.delete');


    /**
     * Create Item
     */
    Route::post('/', [FollowupsController::class, 'createItem'])
        ->name('vh.backend.leadmanagement.api.followups.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [FollowupsController::class, 'getItem'])
        ->name('vh.backend.leadmanagement.api.followups.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [FollowupsController::class, 'updateItem'])
        ->name('vh.backend.leadmanagement.api.followups.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [FollowupsController::class, 'deleteItem'])
        ->name('vh.backend.leadmanagement.api.followups.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [FollowupsController::class, 'listAction'])
        ->name('vh.backend.leadmanagement.api.followups.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [FollowupsController::class, 'itemAction'])
        ->name('vh.backend.leadmanagement.api.followups.item.action');



});
