var lang_mk = {
    'history-description': 'Istorija na valuta vo poslednite 15 dena',
    'home-menu': 'Pocetna',
    'converter-menu': 'Konvertor',
    'history-menu': 'Istorija na podatoci',
    'privacy': 'Politika na privatnost',
    'main-title': 'Kursna Lista Makedonija',
    'title-history-page': 'Istorija na valuti'

};

var lang_en = {
    'history-description': 'History on value in last 15 days',
    'home-menu': 'Home',
    'converter-menu': 'Converter',
    'history-menu': 'History Exchange rate',
    'privacy': 'Private policy',
    'main-title': 'Exchange rate Macedonia',
    'title-history-page': 'History on exchange rate'

};

function changeLanguage(lang)
{
    Object.keys(lang).forEach(function(key){
        //console.log(key, lang[key]);

        key = key.toString();

        let el = document.getElementById(key);

        el.innerHTML = lang[key];
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
