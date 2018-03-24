export class HeaderModule {
    constructor(){
        console.log('HeaderModule is load');

        this.initMethod();
        this.clickHumburgerMenu();
    }

    initMethod(){
        this.hideHumburgerMenu();
    }

    clickHumburgerMenu(){
        $('.humberger_menu img').off('click').on('click', e=>{
           e.preventDefault();
            console.log('clickHumburgerMenu');

            if($('.menu_control').hasClass('show_menu')){
                this.hideHumburgerMenu();
            }else {
                this.showHumburgerMenu();
            }
        });
    }

    showHumburgerMenu(){
        $('.menu_control').addClass('show_menu');
        $('.search_section').addClass('show_menu');

        $('img.open_menu').hide();
        $('img.close_menu').show();
    }

    hideHumburgerMenu(){
        $('.menu_control').removeClass('show_menu');
        $('.search_section').removeClass('show_menu');

        $('img.open_menu').show();
        $('img.close_menu').hide();
    }
}