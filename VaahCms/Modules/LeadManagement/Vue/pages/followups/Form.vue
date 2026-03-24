<script setup>
import {onMounted, ref, watch} from "vue";
import { useFollowupStore } from '../../stores/store-followups'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";


const store = useFollowupStore();
const route = useRoute();

onMounted(async () => {
    /**
     * Fetch the record from the database
     */
    if((!store.item || Object.keys(store.item).length < 1)
            && route.params && route.params.id)
    {
        await store.getItem(route.params.id);
    }

    await store.getFormMenu();
});

//--------form_menu
const form_menu = ref();
const toggleFormMenu = (event) => {
    form_menu.value.toggle(event);
};
//--------/form_menu

</script>
<template>

    <div class="col-6" >

        <Panel class="is-small">

            <template class="p-1" #header>


                <div class="flex flex-row">
                    <div class="p-panel-title">
                        <span v-if="store.item && store.item.id">
                            Update
                        </span>
                        <span v-else>
                            Create
                        </span>
                    </div>

                </div>


            </template>

            <template #icons>


                <div class="p-inputgroup">

                    <Button class="p-button-sm"
                            v-tooltip.left="'View'"
                            v-if="store.item && store.item.id"
                            data-testid="followups-view_item"
                            @click="store.toView(store.item)"
                            icon="pi pi-eye"/>

                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="followups-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create & New"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="followups-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
                    <Button
                        type="button"
                        @click="toggleFormMenu"
                        class="p-button-sm"
                        data-testid="followups-form-menu"
                        icon="pi pi-angle-down"
                        aria-haspopup="true"/>

                    <Menu ref="form_menu"
                          :model="store.form_menu_list"
                          :popup="true" />
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="followups-to-list"
                            @click="store.toList()">
                    </Button>
                </div>



            </template>


            <div v-if="store.item" class="mt-2">

                <Message severity="error"
                         class="p-container-message mb-3"
                         :closable="false"
                         icon="pi pi-trash"
                         v-if="store.item.deleted_at">

                    <div class="flex align-items-center justify-content-between">

                        <div class="">
                            Deleted {{store.item.deleted_at}}
                        </div>

                        <div class="ml-3">
                            <Button label="Restore"
                                    class="p-button-sm"
                                    data-testid="articles-item-restore"
                                    @click="store.itemAction('restore')">
                            </Button>
                        </div>

                    </div>

                </Message>
                <VhField label="Lead">
                    <div class="p-inputgroup">
                        <AutoComplete v-model="store.item.lead"  
                        optionLabel="name" 
                        optionValue="id" 
                        dropdown="true"
                         :suggestions="store.leads" 
                         @complete="store.searchLeads" />           
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Follow Up Date">
                    <div class="p-inputgroup">
                        <Calendar dateOnly
                                  dateFormat="yy-mm-dd"
                                  class="w-full"
                                   placeholder="follow up date"
                                   name="followups-follow_up_date"
                                   data-testid="followups-follow_up_date"
                                   v-model="store.item.follow_up_date" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Follow Up Time">
                    <div class="p-inputgroup">
                        <Calendar timeOnly
                                    hourFormat="24"
                                   class=   "w-full"
                                   placeholder="Enter time of followup"
                                   name="followups-follow_up_time"
                                   data-testid="followups-follow_up_time"
                                   v-model="store.item.follow_up_time" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Note">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter a note"
                                   name="followups-note"
                                   data-testid="followups-note"
                                   v-model="store.item.note" />
                    </div>
                </VhField>
                <VhField label="Status">
                    <div class="p-inputgroup">
                        <Dropdown v-model="store.item.status" 
                        :options="store.assets?.status" optionLabel="name" optionValue="id" 
                        placeholder="Select a Status" checkmark :highlightOnSelect="false"
                         class="w-full md:w-14rem" />
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Is Active">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 name="followups-active"
                                 data-testid="followups-active"
                                 v-model="store.item.is_active"/>
                </VhField>

            </div>
        </Panel>

    </div>

</template>
