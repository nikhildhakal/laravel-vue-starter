import ModelService from "@/services/ModelService";

export default class CategoryService extends ModelService {

    constructor() {
        super();
        this.url = '/categories';
    }
}
