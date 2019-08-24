var lang_mk = {
    'history-description': 'Историја на валути од последните 15 дена',
    'home-menu': 'Почетна',
    'converter-menu': 'Конвертер',
    'history-menu': 'Историја на податоци',
    'privacy': 'Политика и приватност',
    'main-title': 'Курсна листа Македонија',
    'title-history-page': 'Историја на валути',
    'mkd-option-first': 'МАКЕДОНСКИ ДЕНАР',
    'mkd-option-second': 'МАКЕДОНСКИ ДЕНАР'

};

var lang_en = {
    'history-description': 'History on value in last 15 days',
    'home-menu': 'Home',
    'converter-menu': 'Converter',
    'history-menu': 'History Exchange rate',
    'privacy': 'Private policy',
    'main-title': 'Exchange rate Macedonia',
    'title-history-page': 'History on exchange rate',
    'mkd-option-first': 'MACEDONIAN DENAR',
    'mkd-option-second': 'MACEDONIAN DENAR'

};

function changeLanguage(lang)
{
    Object.keys(lang).forEach(function(key){
        //console.log(key, lang[key]);

        key = key.toString();
        try{
            let el = document.getElementById(key);
            el.innerHTML = lang[key];
        }catch (e) {}
    });
}

function onLoad()
{
    let langStorage = localStorage.getItem('lang');
    if(langStorage == null)
    {
        changeLanguage(lang_mk);
    }else if(langStorage === 'mk')
    {
        changeLanguage(lang_mk);
    }else{
        changeLanguage(lang_en);
    }
}

onLoad();


let langMK = document.getElementById('mk');
let langEN = document.getElementById('en');

langMK.addEventListener('click', function (e) {
    localStorage.setItem('lang', 'mk');
    window.location.reload();
});

langEN.addEventListener('click', function (e) {
    localStorage.setItem('lang', 'en');
    window.location.reload();
});
