<template>
    <Page :title="page.title" :breadcrumbs="page.breadcrumbs" :actions="page.actions" @action="onPageAction">
        <template #filters v-if="page.toggleFilters">
            <Filters @clear="onFiltersClear">
                <FiltersRow>
                    <FiltersCol>
                        <TextInput name="name" :label="trans('categories.labels.name')" v-model="mainQuery.filters.name.value"/>
                    </FiltersCol>
                    <FiltersCol>
                        <TextInput name="slug" :label="trans('categories.labels.slug')" v-model="mainQuery.filters.slug.value"/>
                    </FiltersCol>
                    <FiltersCol>
                        <label for="is_active_filter" class="label">
                            <span class="label-text">{{ trans('categories.labels.is_active') }}</span>
                        </label>
                        <select id="is_active_filter" class="select select-bordered w-full" v-model="mainQuery.filters.is_active.value">
                            <option value="">{{ trans('global.phrases.all_records') }}</option>
                            <option value="1">{{ trans('categories.status.active') }}</option>
                            <option value="0">{{ trans('categories.status.inactive') }}</option>
                        </select>
                    </FiltersCol>
                    <FiltersCol>
                        <label for="featured_filter" class="label">
                            <span class="label-text">{{ trans('categories.labels.featured') }}</span>
                        </label>
                        <select id="featured_filter" class="select select-bordered w-full" v-model="mainQuery.filters.featured.value">
                            <option value="">{{ trans('global.phrases.all_records') }}</option>
                            <option value="1">{{ trans('categories.status.featured') }}</option>
                            <option value="0">{{ trans('categories.status.standard') }}</option>
                        </select>
                    </FiltersCol>
                </FiltersRow>
            </Filters>
        </template>

        <template #default>
            <Table
                :id="page.id"
                :headers="table.headers"
                :sorting="table.sorting"
                :actions="table.actions"
                :records="table.records"
                :pagination="table.pagination"
                :is-loading="table.loading"
                @page-changed="onTablePageChange"
                @action="onTableAction"
                @sort="onTableSort"
            >
                <template v-slot:content-name="props">
                    <div class="flex items-center gap-3">
                        <div class="avatar" v-if="props.item.image">
                            <div class="w-10 rounded-lg">
                                <img :src="props.item.image" :alt="props.item.name"/>
                            </div>
                        </div>
                        <div v-else class="w-10 h-10 rounded-lg bg-base-200 flex items-center justify-center">
                            <Icon name="tag" class="h-5 w-5 text-base-content/40"/>
                        </div>
                        <div>
                            <div class="font-medium">{{ props.item.name }}</div>
                            <div class="text-xs text-base-content/50">
                                {{ trans('categories.labels.id') + ': ' + props.item.id }}
                            </div>
                        </div>
                    </div>
                </template>
                <template v-slot:content-parent="props">
                    {{ props.item.parent ? props.item.parent.title : trans('categories.labels.root_category') }}
                </template>
                <template v-slot:content-is_active="props">
                    <span :class="props.item.is_active ? 'badge-success' : 'badge-error'" class="badge badge-sm">
                        {{ props.item.is_active ? trans('categories.status.active') : trans('categories.status.inactive') }}
                    </span>
                </template>
                <template v-slot:content-featured="props">
                    <span :class="props.item.featured ? 'badge-secondary' : 'badge-ghost'" class="badge badge-sm">
                        {{ props.item.featured ? trans('categories.status.featured') : trans('categories.status.standard') }}
                    </span>
                </template>
            </Table>
        </template>
    </Page>

    <Transition name="fade">
        <div v-if="drawer.open" class="fixed inset-0 bg-black/30 z-30" @click="closeDrawer"></div>
    </Transition>

    <Transition name="slide-right">
        <div v-if="drawer.open" class="fixed top-0 right-0 h-full w-full max-w-lg bg-base-100 shadow-2xl z-40 flex flex-col">
            <div class="flex items-center justify-between px-6 py-4 border-b border-base-300/50">
                <h3 class="text-lg font-bold">
                    {{ drawer.mode === 'create' ? trans('categories.labels.new_record') : trans('categories.labels.edit_record') }}
                </h3>
                <button class="btn btn-ghost btn-sm btn-circle" @click="closeDrawer">
                    <Icon name="times" class="h-4 w-4"/>
                </button>
            </div>

            <div class="flex-grow overflow-y-auto p-6" v-if="!drawer.loading">
                <form :id="formId" @submit.prevent="onDrawerSubmit">
                    <TextInput class="mb-4" name="name" :required="true" v-model="drawer.form.name" :label="trans('categories.labels.name')"/>
                    <Dropdown class="mb-4" name="parent" :options="drawer.parents" v-model="drawer.form.parent" :label="trans('categories.labels.parent')"/>
                    <TextInput class="mb-4" type="textarea" name="description" v-model="drawer.form.description" :label="trans('categories.labels.description')"/>
                    <div v-if="drawer.currentImage && !drawer.form.image" class="mb-3">
                        <p class="label-text mb-2">{{ trans('categories.labels.image') }}</p>
                        <img :src="drawer.currentImage" :alt="drawer.form.name" class="w-24 h-24 rounded-lg object-cover border border-base-300"/>
                    </div>
                    <FileInput
                        class="mb-4"
                        name="image"
                        v-model="drawer.form.image"
                        :label="trans('categories.labels.image')"
                        accept="image/jpeg,image/png,image/webp"
                        @clear="drawer.form.image = null"
                    />
                    <TextInput class="mb-4" type="number" name="sort_order" :required="true" v-model="drawer.form.sort_order" :label="trans('categories.labels.sort_order')"/>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="label cursor-pointer justify-start gap-3 rounded-lg border border-base-300 px-4 py-3">
                            <input type="checkbox" class="toggle toggle-secondary" v-model="drawer.form.featured"/>
                            <span class="label-text">{{ trans('categories.labels.featured') }}</span>
                        </label>
                        <label class="label cursor-pointer justify-start gap-3 rounded-lg border border-base-300 px-4 py-3">
                            <input type="checkbox" class="toggle toggle-success" v-model="drawer.form.is_active"/>
                            <span class="label-text">{{ trans('categories.labels.is_active') }}</span>
                        </label>
                    </div>
                </form>
            </div>
            <div v-else class="flex-grow flex items-center justify-center">
                <Spinner/>
            </div>

            <div class="px-6 py-4 border-t border-base-300/50 flex justify-end gap-2">
                <button class="btn btn-ghost btn-sm" @click="closeDrawer">{{ trans('global.buttons.back') }}</button>
                <button class="btn btn-primary btn-sm" @click="onDrawerSubmit" :disabled="drawer.loading">
                    <Icon name="save" class="h-4 w-4 mr-1"/>
                    {{ drawer.mode === 'create' ? trans('global.buttons.save') : trans('global.buttons.update') }}
                </button>
            </div>
        </div>
    </Transition>
</template>

<script>
import {computed, defineComponent, onMounted, reactive, watch} from "vue";
import {trans} from "@/helpers/i18n";
import {getResponseError, prepareQuery} from "@/helpers/api";
import {toUrl} from "@/helpers/routing";
import {clearObject, fillObject} from "@/helpers/data";
import {useToastStore} from "@/stores/toast";
import alertHelpers from "@/helpers/alert";
import CategoryService from "@/services/CategoryService";
import Page from "@/views/layouts/Page";
import Table from "@/views/components/Table";
import Icon from "@/views/components/icons/Icon";
import Spinner from "@/views/components/icons/Spinner";
import Filters from "@/views/components/filters/Filters";
import FiltersRow from "@/views/components/filters/FiltersRow";
import FiltersCol from "@/views/components/filters/FiltersCol";
import TextInput from "@/views/components/input/TextInput";
import FileInput from "@/views/components/input/FileInput";
import Dropdown from "@/views/components/input/Dropdown";

export default defineComponent({
    name: "CategoriesIndex",
    components: {
        Dropdown,
        TextInput,
        FileInput,
        FiltersCol,
        FiltersRow,
        Filters,
        Page,
        Table,
        Icon,
        Spinner,
    },
    setup() {
        const service = new CategoryService();
        const toastStore = useToastStore();

        const mainQuery = reactive({
            page: 1,
            search: '',
            sort: '',
            filters: {
                name: {value: '', comparison: '='},
                slug: {value: '', comparison: '='},
                featured: {value: '', comparison: '='},
                is_active: {value: '', comparison: '='},
            },
        });

        const page = reactive({
            id: 'list_categories',
            title: trans('global.pages.product_categories'),
            breadcrumbs: [
                {
                    name: trans('global.pages.product_categories'),
                    to: toUrl('/categories/list'),
                    active: true,
                },
            ],
            actions: [
                {
                    id: 'filters',
                    name: trans('global.buttons.filters'),
                    icon: 'filter',
                    theme: 'outline',
                },
                {
                    id: 'new',
                    name: trans('global.buttons.add_new'),
                    icon: 'plus',
                },
            ],
            toggleFilters: false,
        });

        const table = reactive({
            headers: {
                name: trans('categories.labels.name'),
                slug: trans('categories.labels.slug'),
                parent: trans('categories.labels.parent'),
                is_active: trans('categories.labels.is_active'),
                featured: trans('categories.labels.featured'),
                sort_order: trans('categories.labels.sort_order'),
            },
            sorting: {
                name: true,
                slug: true,
                is_active: true,
                featured: true,
                sort_order: true,
            },
            pagination: {
                meta: null,
                links: null,
            },
            actions: {
                edit: {
                    id: 'edit',
                    name: trans('global.actions.edit'),
                    icon: 'edit',
                    showName: false,
                },
                delete: {
                    id: 'delete',
                    name: trans('global.actions.delete'),
                    icon: 'trash',
                    showName: false,
                    danger: true,
                },
            },
            loading: false,
            records: [],
        });

        const drawer = reactive({
            open: false,
            mode: 'create',
            categoryId: null,
            loading: false,
            parents: [],
            currentImage: null,
            form: {
                name: '',
                parent: null,
                description: '',
                image: null,
                featured: false,
                is_active: true,
                sort_order: 0,
            },
        });

        const formId = computed(() => drawer.mode === 'create' ? 'create-category' : 'edit-category');

        function resetForm() {
            clearObject(drawer.form);
            drawer.form.featured = false;
            drawer.form.is_active = true;
            drawer.form.sort_order = 0;
            drawer.form.image = null;
            drawer.currentImage = null;
        }

        function openCreateDrawer() {
            resetForm();
            drawer.mode = 'create';
            drawer.categoryId = null;
            drawer.parents = [];
            drawer.loading = true;
            drawer.open = true;

            service.create()
                .then((response) => {
                    drawer.parents = response.data.properties.parents;
                })
                .catch((error) => {
                    toastStore.error(getResponseError(error));
                    drawer.open = false;
                })
                .finally(() => {
                    drawer.loading = false;
                });
        }

        function openEditDrawer(id) {
            resetForm();
            drawer.mode = 'edit';
            drawer.categoryId = id;
            drawer.parents = [];
            drawer.loading = true;
            drawer.open = true;

            service.edit(id)
                .then((response) => {
                    fillObject(drawer.form, response.data.model);
                    drawer.parents = response.data.properties.parents;
                    drawer.currentImage = response.data.model.image;
                    drawer.form.image = null;
                })
                .catch((error) => {
                    toastStore.error(getResponseError(error));
                    drawer.open = false;
                })
                .finally(() => {
                    drawer.loading = false;
                });
        }

        function closeDrawer() {
            if (!drawer.loading) {
                drawer.open = false;
            }
        }

        function formPayload() {
            return {
                name: drawer.form.name,
                parent_id: drawer.form.parent ? drawer.form.parent.id : 'null',
                description: drawer.form.description || 'null',
                image: drawer.form.image,
                featured: drawer.form.featured ? '1' : '0',
                is_active: drawer.form.is_active ? '1' : '0',
                sort_order: String(drawer.form.sort_order ?? 0),
            };
        }

        function onDrawerSubmit() {
            const form = document.getElementById(formId.value);

            if (!form || !form.reportValidity()) {
                return;
            }

            drawer.loading = true;
            const request = drawer.mode === 'create'
                ? service.store(formPayload())
                : service.update(drawer.categoryId, formPayload());

            request
                .then((response) => {
                    toastStore.success(response.data.message);
                    drawer.open = false;
                    fetchPage(mainQuery);
                })
                .catch((error) => {
                    toastStore.error(getResponseError(error));
                })
                .finally(() => {
                    drawer.loading = false;
                });
        }

        function onTableSort(params) {
            mainQuery.sort = params;
        }

        function onTablePageChange(selectedPage) {
            mainQuery.page = selectedPage;
        }

        function onTableAction(params) {
            if (params.action.id === 'edit') {
                openEditDrawer(params.item.id);

                return;
            }

            if (params.action.id === 'delete') {
                alertHelpers.confirmDanger(() => {
                    service.delete(params.item.id)
                        .then((response) => {
                            toastStore.success(response.data.message);
                            fetchPage(mainQuery);
                        })
                        .catch((error) => {
                            toastStore.error(getResponseError(error));
                        });
                });
            }
        }

        function onPageAction(params) {
            if (params.action.id === 'filters') {
                page.toggleFilters = !page.toggleFilters;
            } else if (params.action.id === 'new') {
                openCreateDrawer();
            }
        }

        function onFiltersClear() {
            Object.values(mainQuery.filters).forEach((filter) => {
                filter.value = '';
            });
        }

        function fetchPage(params) {
            table.records = [];
            table.loading = true;

            service.index(prepareQuery(params))
                .then((response) => {
                    table.records = response.data.data;
                    table.pagination.meta = response.data.meta;
                    table.pagination.links = response.data.links;
                })
                .catch((error) => {
                    toastStore.error(getResponseError(error));
                })
                .finally(() => {
                    table.loading = false;
                });
        }

        watch(mainQuery, () => {
            fetchPage(mainQuery);
        });

        onMounted(() => {
            fetchPage(mainQuery);
        });

        return {
            trans,
            page,
            table,
            drawer,
            formId,
            mainQuery,
            onTablePageChange,
            onTableAction,
            onTableSort,
            onPageAction,
            onFiltersClear,
            closeDrawer,
            onDrawerSubmit,
        };
    },
});
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

.slide-right-enter-active, .slide-right-leave-active {
    transition: transform 0.25s ease;
}

.slide-right-enter-from, .slide-right-leave-to {
    transform: translateX(100%);
}
</style>
