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
    'history-description': 'History on value in last 15 days'

};



Object.keys(lang_mk).forEach(function(key){
    console.log(key, lang_mk[key]);

    key = key.toString();

    let el = document.getElementById(key);

    el.innerHTML = lang_mk[key];
});