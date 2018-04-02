import {ApiModule} from '../api';

export class WhoIsYourBk extends ApiModule {
    constructor() {
        super();
        console.log('WhoIsYourBk is load');

        this.whoIsYourBkFormHandler();
        this.checkForm();
    }

    whoIsYourBkFormHandler(){
       $('#who_is_your_bk_button').off('click').on('click', e=>{
           e.preventDefault();

           console.log('whoIsYourBkFormHandler');
           if($('#who_is_your_bk_form').valid()){
               console.log('valid');
               this.sendFormMethod();
           }
       })
    }

    sendFormMethod(){
        this.post({
            data: $('#who_is_your_bk_form').serialize(),
            success: response => {
                console.log(response);
                if(response.status == true){
                    this.renderBukmekerGraph(response.data);
                    this.renderBukmekerList(response.data);
                    this.renderBukmekerTotal(response.data);
                }
            },
        });
    }

    renderBukmekerGraph(data){
        let html = '';
        const bukmekers_list = data.bukmekers_list;
        const total_subscriptions = data.total_subscriptions;
        const total_bukmekers = data.total_bukmekers;
        for(let i = 0; i < bukmekers_list.length; i++){
            let bukmeker_item = bukmekers_list[i];
            let bukmekers_users_count = bukmeker_item.bukmekers_users_count>0?bukmeker_item.bukmekers_users_count:1;
            console.log('bukmekers_list: ' + bukmekers_users_count);
            html += `<div class=\"p${i+1} column_item\" style=\"height: calc((100px*${bukmekers_users_count})/${total_subscriptions}); width: calc(60%/${total_bukmekers})\"></div>`;
        }
        $('.graph_containers.left').html(html);
    }

    renderBukmekerList(data){
        let html = '';
        const bukmekers_list = data.bukmekers_list;
        const total_subscriptions = data.total_subscriptions;
        for(let i = 0; i < bukmekers_list.length; i++) {
            let bukmeker_item = bukmekers_list[i];
            let bukmekers_users_count = bukmeker_item['bukmekers_users_count'];
            let percents = (bukmekers_users_count>0)?(100*bukmekers_users_count/total_subscriptions).toFixed(1):0;

            html += `<li><a href='${bukmeker_item['guid']}'>`;
            html += `  <div class='color_sq p${i+1}'></div>`;
            html += `  <div class='bk_text'>${bukmeker_item['post_name']}</div>`;
            html += `  <div class='percents'>${percents}%</div>`;
            html += "</a></li>";
        }
        $('.bk_list.left').html(html);
    }

    renderBukmekerTotal(data){
        $('.bk_total span.numbers.left').html(data.total_subscriptions);
    }

    checkForm() {
        $('#who_is_your_bk_form').validate({
            ignore: [],
            rules: {
                who_is_your_bk: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                bk_id: {
                    required: true,
                    digits: true,
                    min: 1,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                }
            },
            messages: {
                who_is_your_bk: {
                    required: "Выберите букмекера",
                },
                bk_id: {
                    required: "Выберите букмекера",
                    digits: "Выберите букмекера",
                }
            }
        });
    }
}