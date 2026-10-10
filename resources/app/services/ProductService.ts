import ModelService from "@/services/ModelService";

export default class ProductService extends ModelService {
    constructor() {
        super();
        this.url = '/products';
    }

    public store(payload) {
        return this.post(this.url, this.toFormData(payload), {
            headers: {'Content-Type': 'multipart/form-data'},
        });
    }

    public update(objectId, payload) {
        return this.patch(this.url + `/${objectId}`, this.toFormData(payload), {
            headers: {'Content-Type': 'multipart/form-data'},
        });
    }

    private toFormData(payload): FormData {
        const formData = new FormData();

        Object.entries(payload).forEach(([key, value]) => {
            if (key === 'gallery') {
                return;
            }

            const emptyValue = key === 'slug' ? '' : 'null';
            formData.append(key, value === null || value === '' ? emptyValue : String(value));
        });

        const galleryOrder = [];
        let uploadIndex = 0;

        payload.gallery.forEach((item) => {
            if (item.kind === 'media') {
                galleryOrder.push(`media:${item.id}`);
                return;
            }

            galleryOrder.push(`upload:${uploadIndex}`);
            formData.append(`gallery_uploads[${uploadIndex}]`, item.file);
            uploadIndex++;
        });

        formData.append('gallery_order', JSON.stringify(galleryOrder));

        return formData;
    }
}
