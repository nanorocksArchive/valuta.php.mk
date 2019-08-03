<?php

Flight::route('GET /', ['ExchangeRate', 'onload']);

Flight::route('GET /api/list', ['ExchangeRate','list']);

Flight::route('GET /api/converter/@from/@to/@price', ['ExchangeRate', 'converter']);

Flight::route('GET /api/history/@value', ['ExchangeRate', 'history']);
