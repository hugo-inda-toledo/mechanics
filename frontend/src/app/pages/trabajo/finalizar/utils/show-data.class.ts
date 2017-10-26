export class ShowDataLoading {
    public hidden: boolean = false;
    public message: string = 'Cargando...';
}

export class ShowData{
    public btn_disabled: boolean = false;
    public hidden: boolean = true;
    public loading: ShowDataLoading;
    public finish: boolean = false;
    constructor(){
        this.loading = new ShowDataLoading();
    }
}
