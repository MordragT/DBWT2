<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>NewSite</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>

    <div id="content" class="container">

        <siteheader></siteheader>

        <sitebody></sitebody>

        <sitefooter></sitefooter>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        Vue.component('siteheader', {
            data: function() {
                return {}
            },
            template: '<nav-menu></nav-menu>'
        })

        Vue.component('sitebody', {
            data: function() {
                return {}
            },
            template: `<div>
                <br><br>
                <artikel v-bind:limit-articles="5"></artikel>
                <impressum v-bind:visible="this.$root.$data.impressumVisible"></impressum>
            </div>`
        })

        Vue.component('sitefooter', {
            data: function() {
                return {}
            },
            template: '<button v-on:click="this.$root.toggleImpressum" class="form-control">Impressum</button>'
        })

        Vue.component('impressum', {
            props: {
                visible: false
            },
            data: function() {
                return {}
            },
            template: `<div v-if="this.visible">
                <h1>Impressum</h1>

                <h2>Angaben gem&auml;&szlig; &sect; 5 TMG</h2>
                <p>Gruppe 16<br />
                    Eupenerstra&szlig;e 70<br />
                    52066 Aachen</p>

                <p><strong>Vertreten durch:</strong><br />
                    Thomas Wehmoeller<br />
                    Julien Ahn</p>

                <h2>Kontakt</h2>
                <p>Telefon: +49 (0) 123 44 55 66<br />
                    Telefax: +49 (0) 123 44 55 99<br />
                    E-Mail: mustermann@musterfirma.de</p>
            </div>`
        })

        new Vue({
            el: '#content',
            data: {
                impressumVisible: false
            },
            methods: {
                toggleImpressum: function() {
                    this.impressumVisible = !this.impressumVisible;
                }
            }
        })
    </script>
</body>

</html>
