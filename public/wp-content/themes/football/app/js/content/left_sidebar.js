export class LeftSidebarModule {
    constructor() {
        console.log('LeftSidebarModule is load');

        this.init();
        this.clickOpenMenuHandler();
        this.clickPlusBKHadler();
    }

    init(){
        $('#who_is_your_bk').editableSelect({ filter: false })
            .on('select.editable-select', function (e, el) {
            // el is the selected item "option"
            $('#bk_id').val(el.data('value'));
        });
    }

    clickOpenMenuHandler(){
        $('.has_submenu').off('click').on('click',e=>{
            e.preventDefault();
            console.log('clickOpenMenu');

            this.toglleMenuMethod(e.target);
        });
    }

    toglleMenuMethod(element){
        $(element).closest('li').find('ul.sub_menu').toggle();
        $(element).toggleClass('opens_menu')
    }

    clickPlusBKHadler(){
        $('.more_button_container').off('click').on('click', e=>{
           e.preventDefault();
           const $button = $(e.target);
            console.log('clickPlusBKHadler');
            if($button.hasClass('close_bk_list')){
                console.log('close_bk_list');
                $button.removeClass('close_bk_list').addClass('open_bk_list');
                this.show_bk_list($button)
            }else {
                console.log('open_bk_list');
                $(e.target).removeClass('open_bk_list').addClass('close_bk_list');
                this.hide_bk_list($button)
            }
        });
    }

    show_bk_list(element){
        $('ul.bk_list.left li.hide_item').show('slow');
        element.text('-');
    }

    hide_bk_list(element){
        $('ul.bk_list.left li.hide_item').hide('slow');
        element.text('+');
    }
}