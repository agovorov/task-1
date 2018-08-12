<template>
    <div class="mt-2 col-7">
        <label>Введите адрес</label>
        <div class="input-group">
            <TypeAhead
                    src="http://api.gos/address/search?q=:keyword"
                    :getResponse="getResponse"
                    :minChars="parseInt(minChars)"
            ></TypeAhead>
        </div>
    </div>
</template>

<script>
    import TypeAhead from 'vue2-bootstrap4-typeahead'
    export default {
        components: {
            TypeAhead,
        },
        name: 'app',
        data () {
            return {
                data: '',
                selectFirst: false,
                limit: 6,
                queryParamName: ':keyword',
                minChars: 2,
                delayTime: 250,
                classes: 'typeahead'
            }
        },
        methods: {
            getResponse: function (response) {
                return response.data;
            },
        }
    };
</script>

<style>
</style>