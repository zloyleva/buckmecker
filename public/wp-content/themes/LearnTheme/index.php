<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div id="app">
                <ul>
                    <todo-item
                        v-for="item in groceryList"
                        v-bind:todo="item"
                    ></todo-item>
                </ul>
            </div>
        </div>
    </div>

    <script>

        Vue.component('todo-item',{
            props:['todo'],
            template: '<li>{{todo.id}}. {{ todo.text }}</li>'
        });
        var app = new Vue({
            el: '#app',
            data: {
                groceryList: [
                    { id: 0, text: 'Овощи' },
                    { id: 1, text: 'Сыр' },
                    { id: 2, text: 'Что там ещё люди едят?' }
                ]
            }
        });

    </script>

<?php get_footer(); ?>