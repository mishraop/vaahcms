<?php

use VaahCms\Modules\LeadManagement\Http\Controllers\Backend\FollowupsController;

Route::group(
    [
        'prefix' => 'backend/leadmanagement/followups',
        
        'middleware' => ['web', 'has.backend.access'],
        
],
function () {
    /**
     * Get Assets
     */

Route::any('/lead', [FollowupsController::class, 'searchLeads'])
        ->name('vh.backend.leadmanagement.followups.item.action');

    Route::get('/assets', [FollowupsController::class, 'getAssets'])
        ->name('vh.backend.leadmanagement.followups.assets');
    /**
     * Get List
     */
    Route::get('/', [FollowupsController::class, 'getList'])
        ->name('vh.backend.leadmanagement.followups.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [FollowupsController::class, 'updateList'])
        ->name('vh.backend.leadmanagement.followups.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [FollowupsController::class, 'deleteList'])
        ->name('vh.backend.leadmanagement.followups.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', [FollowupsController::class, 'fillItem'])
        ->name('vh.backend.leadmanagement.followups.fill');

    /**
     * Create Item
     */
    Route::post('/', [FollowupsController::class, 'createItem'])
        ->name('vh.backend.leadmanagement.followups.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [FollowupsController::class, 'getItem'])
        ->name('vh.backend.leadmanagement.followups.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [FollowupsController::class, 'updateItem'])
        ->name('vh.backend.leadmanagement.followups.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [FollowupsController::class, 'deleteItem'])
        ->name('vh.backend.leadmanagement.followups.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [FollowupsController::class, 'listAction'])
        ->name('vh.backend.leadmanagement.followups.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [FollowupsController::class, 'itemAction'])
        ->name('vh.backend.leadmanagement.followups.item.action');

    //---------------------------------------------------------

});
