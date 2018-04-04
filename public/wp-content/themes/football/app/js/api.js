export class ApiModule {
    constructor() {
        console.log('ApiModule');

        this.apiUrl = football_ajax.url;
    }

    apiHeaders() {
        return {
            'accept': 'application/json',
            'content-type': 'application/x-www-form-urlencoded',
            'cache-control': 'no-cache',
        };
    };

    get (settings) {
        $.ajax(Object.assign(this.ajaxSettings(), settings)).fail(function (e) {

        });
    };

    post(settings) {
        this.get(Object.assign(settings, {type: 'post'}));
    };

    ajaxSettings() {
        return {
            headers: this.apiHeaders(),
            type: 'get',
            dataType: 'json',
            data: {},
            url: this.apiUrl,
            beforeSend: () => {
            },
            success: () => {
            },
            error: () => {
            },
            retries: 1
        };
    };

    apiHeaders() {
        return {
            // 'authorization': 'Bearer ' + this.apiToken,
            'accept': 'application/json',
            'content-type': 'application/x-www-form-urlencoded',
            'cache-control': 'no-cache',
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        };
    };
}