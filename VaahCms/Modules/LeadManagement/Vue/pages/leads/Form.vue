<script setup>
import {onMounted, ref, watch} from "vue";
import { useLeadStore } from '../../stores/store-leads'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';
import Dropdown from "primevue/dropdown";


const store = useLeadStore();
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
                            data-testid="leads-view_item"
                            @click="store.toView(store.item)"
                            icon="pi pi-eye"/>

                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="leads-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create & New"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="leads-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
                    <Button
                        type="button"
                        @click="toggleFormMenu"
                        class="p-button-sm"
                        data-testid="leads-form-menu"
                        icon="pi pi-angle-down"
                        aria-haspopup="true"/>

                    <Menu ref="form_menu"
                          :model="store.form_menu_list"
                          :popup="true" />
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="leads-to-list"
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


                <VhField label="Name">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the name"
                                   name="leads-name"
                                   data-testid="leads-name"
                                   @update:modelValue="store.watchItem"
                                   v-model="store.item.name" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Tags">
                    <div class="p-inputgroup">
                        <AutoComplete v-model="store.item.tags"  
                        optionLabel="name" 
                        optionValue="id" 
                        multiple
                        dropdown="true"
                         :suggestions="store.tags" 
                         @complete="store.searchTags" />           
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Email">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the email"
                                   name="leads-email"
                                   data-testid="leads-email"
                                   v-model="store.item.email" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Phone">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the phone"
                                   name="leads-phone"
                                   data-testid="leads-phone"
                                   v-model="store.item.phone" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Source">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the source"
                                   name="leads-source"
                                   data-testid="leads-source"
                                   v-model="store.item.source"/>
                    </div>
                </VhField>
                <VhField label="Assign Executive">
                    <div class="p-inputgroup">
                         <Dropdown
                            v-model="store.item.assigned_to"
                            :options="store.assets?.users"
                            optionLabel="name"
                            optionValue="id"
                            placeholder="Select User"
                            class="w-full"
        />
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>
                <VhField label="Status">
                    <div class="p-inputgroup">
                        <Dropdown v-model="store.item.status" 
                        :options="store.assets?.status" optionLabel="name" optionValue="id" 
                        placeholder="Select a Status" checkmark :highlightOnSelect="false"
                         class="w-full md:w-14rem" />
                    </div>
                </VhField>

                <VhField label="Slug">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the slug"
                                   name="leads-slug"
                                   data-testid="leads-slug"
                                   v-model="store.item.slug" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Is Active">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 name="leads-active"
                                 data-testid="leads-active"
                                 v-model="store.item.is_active"/>
                </VhField>

            </div>
        </Panel>

    </div>

</template>
