<?php

Flight::route('GET /', ['LoadClass', 'onload']);

Flight::route('GET /api/list', ['ListClass','list']);

Flight::route('GET /api/converter/@from/@to/@price', ['ConverterClass', 'converter']);

Flight::route('GET /api/history/@value', ['HistoryClass', 'history']);
