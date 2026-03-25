<script setup>
import { vaah } from '../../../vaahvue/pinia/vaah'
import { useLeadStore } from '../../../stores/store-leads'

const store = useLeadStore();
const useVaah = vaah();

</script>

<template>

    <div v-if="store.list">
        <!--table-->
         <DataTable :value="store.list.data"
                   dataKey="id"
                   :rowClass="store.setRowClass"
                   class="p-datatable-sm p-datatable-hoverable-rows"
                   :nullSortOrder="-1"
                   v-model:selection="store.action.items"
                   stripedRows
                   responsiveLayout="scroll">

            <Column selectionMode="multiple"
                    v-if="store.isViewLarge()"
                    headerStyle="width: 3em">
            </Column>

            <Column field="id" header="ID" :style="{width: '80px'}" :sortable="true">
            </Column>

            <Column field="name" header="Name"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.name}}
                </template>

            </Column>
            <Column field="email" header="Email"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.email}}
                </template>

            </Column>
            <Column field="phone" header="Phone"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.phone}}
                </template>

            </Column>
            <Column field="source" header="Source"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.source}}
                </template>

            </Column>
            <Column field="tags" header="Tags"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.tags.length}}
                </template>

            </Column>
            <Column field="follow_up_count" header="Follow Ups"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <div v-if="prop.data.follow_up.length>0">
<Badge class="cursor-pointer" @click="store.viewFollowUps(prop.data)">{{prop.data.follow_up.length}}</Badge>
                    </div>
                    <div v-else>
<Badge>0</Badge>
                    </div>



                </template>

            </Column>
            <Column field="assigned_to" header="Assigned User"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.assigned_user?.name}}
                </template>

            </Column>
            <Column field="status" header="Status"
                    class="overflow-wrap-anywhere"
                    :sortable="true">

                <template #body="prop">
                    <Badge v-if="prop.data.deleted_at"
                           value="Trashed"
                           severity="danger"></Badge>
                    {{prop.data.status?.name}}
                </template>

            </Column>


                <!-- <Column field="updated_at" header="Updated"
                        v-if="store.isViewLarge()"
                        style="width:150px;"
                        :sortable="true">

                    <template #body="prop">
                        {{useVaah.strToSlug(prop.data.updated_at)}}
                    </template>

                </Column> -->

            <!-- <Column field="is_active" v-if="store.isViewLarge()"
                    :sortable="true"
                    style="width:100px;"
                    header="Is Active">

                <template #body="prop">
                    <InputSwitch v-model.bool="prop.data.is_active"
                                 data-testid="leads-table-is-active"
                                 v-bind:false-value="0"  v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 @input="store.toggleIsActive(prop.data)">
                    </InputSwitch>
                </template>

            </Column> -->

            <Column field="actions" style="width:150px;"
                    :style="{width: store.getActionWidth() }"
                    :header="store.getActionLabel()">

                <template #body="prop">
                    <div class="p-inputgroup ">

                        <Button class="p-button-tiny p-button-text"
                                data-testid="leads-table-to-view"
                                v-tooltip.top="'View'"
                                @click="store.toView(prop.data)"
                                icon="pi pi-eye" />

                        <Button class="p-button-tiny p-button-text"
                                data-testid="leads-table-to-edit"
                                v-tooltip.top="'Update'"
                                @click="store.toEdit(prop.data)"
                                icon="pi pi-pencil" />

                        <Button class="p-button-tiny p-button-danger p-button-text"
                                data-testid="leads-table-action-trash"
                                v-if="store.isViewLarge() && !prop.data.deleted_at"
                                @click="store.itemAction('trash', prop.data)"
                                v-tooltip.top="'Trash'"
                                icon="pi pi-trash" />


                        <Button class="p-button-tiny p-button-success p-button-text"
                                data-testid="leads-table-action-restore"
                                v-if="store.isViewLarge() && prop.data.deleted_at"
                                @click="store.itemAction('restore', prop.data)"
                                v-tooltip.top="'Restore'"
                                icon="pi pi-replay" />


                    </div>

                </template>


            </Column>

             <template #empty>
                 <div class="text-center py-3">
                     No records found.
                 </div>
             </template>

        </DataTable>
        <!--/table-->

        <!--paginator-->
        <Paginator v-if="store.query.rows"
                   v-model:rows="store.query.rows"
                   :totalRecords="store.list.total"
                   :first="((store.query.page??1)-1)*store.query.rows"
                   @page="store.paginate($event)"
                   :rowsPerPageOptions="store.rows_per_page"
                   class="bg-white-alpha-0 pt-2">
        </Paginator>
        <!--/paginator-->

    </div>
<Sidebar 
    v-model:visible="store.view_sidebar" 
    header="Lead Follow Ups" 
    position="right"
     style="width: 700px;"

>
    <div v-if="store.selected_lead">

        <!-- Lead Info -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold">
                {{ store.selected_lead.name }}
            </h3>
            <p class="text-sm text-gray-500">
                {{ store.selected_lead.email }}
            </p>
        </div>

        <!-- Follow Ups Table -->
        <DataTable 
            :value="store.selected_lead.follow_up" 
            responsiveLayout="scroll"
            stripedRows
        >

            <Column field="id" header="#" style="width: 60px"></Column>

            <Column header="Follow Up Date">
                <template #body="slotProps">
                    <Badge 
                v-if="store.getFollowUpStatus(slotProps.data)"
                :value="store.getFollowUpStatus(slotProps.data).label"
            :severity="store.getFollowUpStatus(slotProps.data).severity"
            />
                    {{ slotProps.data.follow_up_date }}
                </template>
            </Column>

            <Column header="Time">
                <template #body="slotProps">
                    {{ slotProps.data.follow_up_time }}
                </template>
            </Column>

            <Column field="note" header="Note"></Column>

            <Column header="Status">
                <template #body="slotProps">
                    <Tag :value="slotProps.data.status.name" severity="success" />
                </template>
            </Column>

        </DataTable>

        <!-- Empty State -->
        <div 
            v-if="!store.selected_lead.follow_up || store.selected_lead.follow_up.length === 0"
            class="text-center text-gray-500 mt-4"
        >
            No follow-ups found
        </div>

    </div>
</Sidebar>
</template>
