<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>NewSite</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

</head>

<body>

<div id="content">

    <siteheader></siteheader>

    <sitebody></sitebody>

    <sitefooter></sitefooter>

</div>

<!-- https://www.e-recht24.de/impressum-generator.html -->
<script type="text/x-template" id="impressumhtml">
    <div v-if="this.$root.$data.impressumshow">
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
    </div>
</script>

<script>

    Vue.component('siteheader', {
        data: function () {
            return {
            }
        },
        template: '<p> Dies ist der Header </p>'
    })

    Vue.component('sitebody', {
        data: function () {
            return {
            }
        },
        template: '<impressum></impressum>'
    })

    Vue.component('sitefooter', {
        data: function () {
            return {

            }
        },
        template:
                '<a v-on:click="setimpressum">Impressum </a>',
        methods:{
            setimpressum : function(){
                this.$root.$data.impressumshow = !this.$root.$data.impressumshow;
            }
        }

    })

    Vue.component('impressum', {
        data: function () {
            return {

            }
        },
        template: '#impressumhtml'

    })

    new Vue({
        el: '#content',
        data: {
            impressumshow: false
        }
    })

</script>

</body>

</html>
