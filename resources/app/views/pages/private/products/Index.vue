<template>
    <Page :title="page.title" :breadcrumbs="page.breadcrumbs" :actions="page.actions" @action="onPageAction">
        <template #filters v-if="page.toggleFilters">
            <Filters @clear="onFiltersClear">
                <FiltersRow>
                    <FiltersCol>
                        <Dropdown name="category_filter" :options="filterProperties.categories" v-model="mainQuery.filters.category_id.value" :label="trans('products.labels.category')"/>
                    </FiltersCol>
                    <FiltersCol>
                        <label for="stock_filter" class="label"><span class="label-text">{{ trans('products.labels.stock') }}</span></label>
                        <select id="stock_filter" class="select select-bordered w-full" v-model="mainQuery.filters.in_stock.value">
                            <option value="">{{ trans('global.phrases.all_records') }}</option>
                            <option value="1">{{ trans('products.status.in_stock') }}</option>
                            <option value="0">{{ trans('products.status.out_of_stock') }}</option>
                        </select>
                    </FiltersCol>
                    <FiltersCol>
                        <label for="active_filter" class="label"><span class="label-text">{{ trans('products.labels.is_active') }}</span></label>
                        <select id="active_filter" class="select select-bordered w-full" v-model="mainQuery.filters.is_active.value">
                            <option value="">{{ trans('global.phrases.all_records') }}</option>
                            <option value="1">{{ trans('products.status.active') }}</option>
                            <option value="0">{{ trans('products.status.inactive') }}</option>
                        </select>
                    </FiltersCol>
                    <FiltersCol>
                        <label for="featured_filter" class="label"><span class="label-text">{{ trans('products.labels.featured') }}</span></label>
                        <select id="featured_filter" class="select select-bordered w-full" v-model="mainQuery.filters.featured.value">
                            <option value="">{{ trans('global.phrases.all_records') }}</option>
                            <option value="1">{{ trans('products.status.featured') }}</option>
                            <option value="0">{{ trans('products.status.standard') }}</option>
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
                        <div class="avatar" v-if="props.item.image_thumb || props.item.image">
                            <div class="w-10 rounded-lg">
                                <img :src="props.item.image_thumb || props.item.image" :alt="props.item.name"/>
                            </div>
                        </div>
                        <div v-else class="w-10 h-10 rounded-lg bg-base-200 flex items-center justify-center">
                            <Icon name="photo" class="h-5 w-5 text-base-content/40"/>
                        </div>
                        <div>
                            <div class="font-medium">{{ props.item.name }}</div>
                            <div class="text-xs text-base-content/50">{{ props.item.sku || trans('products.labels.id') + ': ' + props.item.id }}</div>
                        </div>
                    </div>
                </template>
                <template v-slot:content-category="props">{{ props.item.category?.title || '—' }}</template>
                <template v-slot:content-price="props">
                    <div v-if="props.item.sale_price">
                        <span class="font-semibold text-success">{{ props.item.sale_price }}</span>
                        <span class="ml-2 text-xs line-through text-base-content/40">{{ props.item.price }}</span>
                    </div>
                    <span v-else>{{ props.item.price }}</span>
                </template>
                <template v-slot:content-quantity="props">
                    <span :class="props.item.in_stock ? 'badge-success' : 'badge-error'" class="badge badge-sm">
                        {{ props.item.quantity }}
                    </span>
                </template>
                <template v-slot:content-is_active="props">
                    <span :class="props.item.is_active ? 'badge-success' : 'badge-error'" class="badge badge-sm">
                        {{ props.item.is_active ? trans('products.status.active') : trans('products.status.inactive') }}
                    </span>
                </template>
                <template v-slot:content-featured="props">
                    <span :class="props.item.featured ? 'badge-secondary' : 'badge-ghost'" class="badge badge-sm">
                        {{ props.item.featured ? trans('products.status.featured') : trans('products.status.standard') }}
                    </span>
                </template>
            </Table>
        </template>
    </Page>

    <Transition name="fade">
        <div v-if="drawer.open" class="fixed inset-0 bg-black/30 z-30" @click="closeDrawer"></div>
    </Transition>

    <Transition name="slide-right">
        <div v-if="drawer.open" class="fixed top-0 right-0 h-full w-full max-w-2xl bg-base-100 shadow-2xl z-40 flex flex-col">
            <div class="flex items-center justify-between px-6 py-4 border-b border-base-300/50">
                <h3 class="text-lg font-bold">{{ drawer.mode === 'create' ? trans('products.labels.new_record') : trans('products.labels.edit_record') }}</h3>
                <button class="btn btn-ghost btn-sm btn-circle" @click="closeDrawer"><Icon name="times" class="h-4 w-4"/></button>
            </div>

            <div class="flex-grow overflow-y-auto p-6" v-if="!drawer.loading">
                <form :id="formId" @submit.prevent="onDrawerSubmit" class="space-y-6">
                    <section>
                        <h4 class="font-semibold mb-3">{{ trans('products.labels.name') }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <TextInput name="name" :required="true" v-model="drawer.form.name" @update:modelValue="updateSlug" :label="trans('products.labels.name')"/>
                            <TextInput name="slug" :readonly="true" v-model="drawer.form.slug" :label="trans('products.labels.slug')"/>
                            <TextInput name="sku" v-model="drawer.form.sku" :label="trans('products.labels.sku')"/>
                            <Dropdown name="category" :required="true" :options="drawer.properties.categories" v-model="drawer.form.category" :label="trans('products.labels.category')"/>
                        </div>
                        <TextInput class="mt-4" type="textarea" name="description" v-model="drawer.form.description" :label="trans('products.labels.description')"/>
                    </section>

                    <section class="border-t border-base-300/50 pt-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <TextInput type="number" name="price" :required="true" min="0" step="0.01" v-model="drawer.form.price" :label="trans('products.labels.price')"/>
                            <TextInput type="number" name="sale_price" min="0" step="0.01" v-model="drawer.form.sale_price" :label="trans('products.labels.sale_price')"/>
                            <TextInput type="number" name="quantity" :required="true" min="0" step="1" v-model="drawer.form.quantity" :label="trans('products.labels.quantity')"/>
                            <div class="grid grid-cols-2 gap-2">
                                <TextInput type="number" name="size_value" min="0" step="0.01" v-model="drawer.form.size_value" :label="trans('products.labels.size_value')"/>
                                <Dropdown name="size_unit" :options="drawer.properties.size_units" v-model="drawer.form.size_unit" :label="trans('products.labels.size_unit')"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <label class="label cursor-pointer justify-start gap-3 rounded-lg border border-base-300 px-4 py-3">
                                <input type="checkbox" class="toggle toggle-secondary" v-model="drawer.form.featured"/>
                                <span class="label-text">{{ trans('products.labels.featured') }}</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-3 rounded-lg border border-base-300 px-4 py-3">
                                <input type="checkbox" class="toggle toggle-success" v-model="drawer.form.is_active"/>
                                <span class="label-text">{{ trans('products.labels.is_active') }}</span>
                            </label>
                        </div>
                    </section>

                    <section class="border-t border-base-300/50 pt-5">
                        <h4 class="font-semibold">{{ trans('products.labels.gallery') }}</h4>
                        <p class="text-xs text-base-content/50 mb-3">{{ trans('products.labels.gallery_help') }}</p>
                        <div v-if="drawer.form.gallery.length" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4">
                            <div v-for="(item, index) in drawer.form.gallery" :key="item.key" class="relative rounded-lg border border-base-300 overflow-hidden bg-base-200">
                                <img :src="item.thumb_url || item.preview" :alt="item.name" class="w-full aspect-square object-cover"/>
                                <span v-if="index === 0" class="absolute top-2 left-2 badge badge-primary badge-sm">Cover</span>
                                <button type="button" class="btn btn-error btn-xs btn-circle absolute top-2 right-2" @click="removeGalleryItem(index)"><Icon name="times" class="h-3 w-3"/></button>
                                <div class="flex justify-center gap-1 p-2 bg-base-100">
                                    <button type="button" class="btn btn-ghost btn-xs" :disabled="index === 0" @click="moveGalleryItem(index, -1)"><Icon name="angle-left" class="h-3 w-3"/></button>
                                    <button type="button" class="btn btn-ghost btn-xs" :disabled="index === drawer.form.gallery.length - 1" @click="moveGalleryItem(index, 1)"><Icon name="angle-right" class="h-3 w-3"/></button>
                                </div>
                            </div>
                        </div>
                        <FileInput
                            v-if="drawer.form.gallery.length < 5"
                            name="gallery"
                            :multiple="true"
                            v-model="drawer.newImages"
                            :label="trans('products.labels.gallery')"
                            accept="image/jpeg,image/png,image/webp"
                            @change="onGalleryFilesSelected"
                            @clear="drawer.newImages = []"
                        />
                    </section>
                </form>
            </div>
            <div v-else class="flex-grow flex items-center justify-center"><Spinner/></div>

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
import {useToastStore} from "@/stores/toast";
import {useAuthStore} from "@/stores/auth";
import alertHelpers from "@/helpers/alert";
import abilities from "@/stub/abilities";
import ProductService from "@/services/ProductService";
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
    name: "ProductsIndex",
    components: {Dropdown, TextInput, FileInput, FiltersCol, FiltersRow, Filters, Page, Table, Icon, Spinner},
    setup() {
        const service = new ProductService();
        const toastStore = useToastStore();
        const authStore = useAuthStore();

        const mainQuery = reactive({
            page: 1,
            search: '',
            sort: '',
            filters: {
                category_id: {value: null, comparison: '='},
                in_stock: {value: '', comparison: '='},
                featured: {value: '', comparison: '='},
                is_active: {value: '', comparison: '='},
            },
        });

        const filterProperties = reactive({categories: []});
        const page = reactive({
            id: 'list_products',
            title: trans('global.pages.products'),
            breadcrumbs: [{name: trans('global.pages.products'), to: toUrl('/products/list'), active: true}],
            actions: [
                {id: 'filters', name: trans('global.buttons.filters'), icon: 'filter', theme: 'outline'},
                ...(authStore.hasAbilities(abilities.CREATE_PRODUCT) ? [{id: 'new', name: trans('global.buttons.add_new'), icon: 'plus'}] : []),
            ],
            toggleFilters: false,
        });

        const table = reactive({
            headers: {
                name: trans('products.labels.name'),
                category: trans('products.labels.category'),
                price: trans('products.labels.price'),
                quantity: trans('products.labels.stock'),
                is_active: trans('products.labels.is_active'),
                featured: trans('products.labels.featured'),
            },
            sorting: {name: true, price: true, quantity: true, is_active: true, featured: true},
            pagination: {meta: null, links: null},
            actions: {
                ...(authStore.hasAbilities(abilities.EDIT_PRODUCT) ? {edit: {id: 'edit', name: trans('global.actions.edit'), icon: 'edit', showName: false}} : {}),
                ...(authStore.hasAbilities(abilities.DELETE_PRODUCT) ? {delete: {id: 'delete', name: trans('global.actions.delete'), icon: 'trash', showName: false, danger: true}} : {}),
            },
            loading: false,
            records: [],
        });

        const drawer = reactive({
            open: false,
            mode: 'create',
            productId: null,
            loading: false,
            newImages: [],
            properties: {categories: [], size_units: []},
            form: {
                name: '', slug: '', sku: '', category: null, description: '',
                price: '', sale_price: '', quantity: 0, size_value: '', size_unit: null,
                featured: false, is_active: true, gallery: [],
            },
        });

        const formId = computed(() => drawer.mode === 'create' ? 'create-product' : 'edit-product');

        function resetForm() {
            drawer.form.gallery.forEach((item) => {
                if (item.kind === 'upload') URL.revokeObjectURL(item.preview);
            });
            Object.assign(drawer.form, {
                name: '', slug: '', sku: '', category: null, description: '',
                price: '', sale_price: '', quantity: 0, size_value: '', size_unit: null,
                featured: false, is_active: true, gallery: [],
            });
            drawer.newImages = [];
        }

        function applyProperties(properties) {
            drawer.properties.categories = properties.categories;
            drawer.properties.size_units = properties.size_units;
            filterProperties.categories = properties.categories;
        }

        function openCreateDrawer() {
            resetForm();
            drawer.mode = 'create';
            drawer.productId = null;
            drawer.loading = true;
            drawer.open = true;
            service.create().then((response) => applyProperties(response.data.properties))
                .catch((error) => { toastStore.error(getResponseError(error)); drawer.open = false; })
                .finally(() => { drawer.loading = false; });
        }

        function openEditDrawer(id) {
            resetForm();
            drawer.mode = 'edit';
            drawer.productId = id;
            drawer.loading = true;
            drawer.open = true;
            service.edit(id).then((response) => {
                const model = response.data.model;
                applyProperties(response.data.properties);
                Object.assign(drawer.form, {
                    name: model.name,
                    slug: model.slug,
                    sku: model.sku || '',
                    category: model.category,
                    description: model.description || '',
                    price: model.price,
                    sale_price: model.sale_price || '',
                    quantity: model.quantity,
                    size_value: model.size_value || '',
                    size_unit: model.size_unit ? response.data.properties.size_units.find((unit) => unit.id === model.size_unit) : null,
                    featured: model.featured,
                    is_active: model.is_active,
                    gallery: model.images.map((image) => ({...image, key: `media-${image.id}`, kind: 'media'})),
                });
            }).catch((error) => { toastStore.error(getResponseError(error)); drawer.open = false; })
                .finally(() => { drawer.loading = false; });
        }

        function closeDrawer() {
            if (!drawer.loading) drawer.open = false;
        }

        function onGalleryFilesSelected() {
            const files = Array.isArray(drawer.newImages) ? drawer.newImages : [];
            const available = Math.max(0, 5 - drawer.form.gallery.length);

            files.slice(0, available).forEach((file) => {
                drawer.form.gallery.push({
                    key: `upload-${Date.now()}-${Math.random()}`,
                    kind: 'upload',
                    file,
                    name: file.name,
                    preview: URL.createObjectURL(file),
                });
            });

            if (files.length > available) toastStore.error(trans('products.labels.gallery_help'));
            drawer.newImages = [];
        }

        function removeGalleryItem(index) {
            const [item] = drawer.form.gallery.splice(index, 1);
            if (item?.kind === 'upload') URL.revokeObjectURL(item.preview);
        }

        function moveGalleryItem(index, direction) {
            const nextIndex = index + direction;
            if (nextIndex < 0 || nextIndex >= drawer.form.gallery.length) return;
            const [item] = drawer.form.gallery.splice(index, 1);
            drawer.form.gallery.splice(nextIndex, 0, item);
        }

        function formPayload() {
            return {
                name: drawer.form.name,
                slug: drawer.form.slug,
                sku: drawer.form.sku,
                category_id: drawer.form.category?.id || null,
                description: drawer.form.description,
                price: drawer.form.price,
                sale_price: drawer.form.sale_price,
                quantity: drawer.form.quantity,
                size_value: drawer.form.size_value,
                size_unit: drawer.form.size_unit?.id || null,
                featured: drawer.form.featured ? '1' : '0',
                is_active: drawer.form.is_active ? '1' : '0',
                gallery: drawer.form.gallery,
            };
        }

        function updateSlug(name) {
            drawer.form.slug = name
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        function onDrawerSubmit() {
            const form = document.getElementById(formId.value);
            if (!form || !form.reportValidity()) return;

            drawer.loading = true;
            const request = drawer.mode === 'create'
                ? service.store(formPayload())
                : service.update(drawer.productId, formPayload());

            request.then((response) => {
                toastStore.success(response.data.message);
                drawer.open = false;
                fetchPage(mainQuery);
            }).catch((error) => toastStore.error(getResponseError(error)))
                .finally(() => { drawer.loading = false; });
        }

        function onTableSort(params) { mainQuery.sort = params; }
        function onTablePageChange(selectedPage) { mainQuery.page = selectedPage; }
        function onPageAction(params) {
            if (params.action.id === 'filters') page.toggleFilters = !page.toggleFilters;
            if (params.action.id === 'new') openCreateDrawer();
        }
        function onFiltersClear() {
            mainQuery.filters.category_id.value = null;
            ['in_stock', 'featured', 'is_active'].forEach((key) => { mainQuery.filters[key].value = ''; });
        }
        function onTableAction(params) {
            if (params.action.id === 'edit') return openEditDrawer(params.item.id);
            if (params.action.id === 'delete') {
                alertHelpers.confirmDanger(() => service.delete(params.item.id)
                    .then((response) => { toastStore.success(response.data.message); fetchPage(mainQuery); })
                    .catch((error) => toastStore.error(getResponseError(error))));
            }
        }

        function fetchPage(params) {
            table.records = [];
            table.loading = true;
            service.index(prepareQuery(params)).then((response) => {
                table.records = response.data.data;
                table.pagination.meta = response.data.meta;
                table.pagination.links = response.data.links;
                if (response.data.properties) applyProperties(response.data.properties);
            }).catch((error) => toastStore.error(getResponseError(error)))
                .finally(() => { table.loading = false; });
        }

        watch(mainQuery, () => fetchPage(mainQuery));
        onMounted(() => {
            fetchPage(mainQuery);
        });

        return {
            trans, page, table, drawer, formId, mainQuery, filterProperties,
            onTablePageChange, onTableAction, onTableSort, onPageAction, onFiltersClear,
            closeDrawer, onDrawerSubmit, onGalleryFilesSelected, removeGalleryItem, moveGalleryItem, updateSlug,
        };
    },
});
</script>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity 0.2s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
.slide-right-enter-active, .slide-right-leave-active { transition: transform 0.25s ease; }
.slide-right-enter-from, .slide-right-leave-to { transform: translateX(100%); }
</style>
