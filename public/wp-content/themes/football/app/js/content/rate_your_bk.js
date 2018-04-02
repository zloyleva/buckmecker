import {ApiModule} from '../api';

export class RateYourBk extends ApiModule {
    constructor() {
        super();
        console.log('RateYourBk is load');

        this.RateYourBkFormHandler();
        // this.checkForm();
    }

    RateYourBkFormHandler(){
        $('#rate_bk_button').off('click').on('click', e=>{
            e.preventDefault();

            console.log('RateYourBkFormHandler');
            if($('#rate_your_bk').valid()){
                console.log('valid');
                this.sendFormMethod();
            }
        })
    }

    sendFormMethod(){
        this.post({
            data: $('#rate_your_bk').serialize(),
            success: response => {
                console.log(response);
                if(response.status == true){

                }
            },
        });
    }
}