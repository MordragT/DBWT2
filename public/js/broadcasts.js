Echo.channel('forall')
    .listen('Maintenance', e => {
        alert("In Kürze warten wir Abalo für Sie.\nNach einer kurzen Pause sind wir wieder\nfür Sie da! Versprochen.")
    });

let user_id = document.querySelector('meta[name="user_id"]').content;
let article_name = "not found";
Echo.channel(`ab_user.${user_id}`)
    .listen('ArticleSold', e => {
        axios.get(`/api/articles/id/${e.article_id}`)
            .then(response => {
                article_name = response.data.ab_name;
            });
        alert(`Großartig! Ihr Artikel ${article_name} wurde erfolgreich verkauft!`);
    });