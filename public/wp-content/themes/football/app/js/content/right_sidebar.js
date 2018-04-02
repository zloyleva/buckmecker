export class RightSidebarModule {
    constructor() {
        console.log('RightSidebarModule is load');

        this.init();
        this.clickOpenBKListHandler();
        this.changeRangeHandler();
    }

    init(){
        $('#select_bk').editableSelect({ filter: false })
            .on('select.editable-select', function (e, el) {
                // el is the selected item "option"
                $('#rate_bk_id').val(el.data('value'));
            });
    }

    changeRangeHandler(){
        $('#bk_rate').change(e=>{
            const $range = $(e.target);
            $('.range_value').html($range.val());
            $('.range_value').css('left',`${$range.val()}%`);
        });
    }

    clickOpenBKListHandler(){
        $('#show_bk_list').off('click').on('click',e=>{
            e.preventDefault();
            const $button = $(e.target);
            console.log('show_bk_list');

            if($button.hasClass('close_bk_list')){
                console.log('close_bk_list');
                $button.removeClass('close_bk_list').addClass('open_bk_list');
                this.show_bk_list($button);
            }else {
                console.log('open_bk_list');
                $button.removeClass('open_bk_list').addClass('close_bk_list');
                this.hide_bk_list($button);
            }
        });
    }

    show_bk_list(element){
        $('ul.bk_list_items li.hide_item').show('slow');
        element.text('-');
    }

    hide_bk_list(element){
        $('ul.bk_list_items li.hide_item').hide('slow');
        element.text('+');
    }
}