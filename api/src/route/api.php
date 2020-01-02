<?php

Flight::route('GET /', ['LoadClass', 'onload']);

Flight::route('POST /api/list', ['ListClass', 'list']);

Flight::route('POST /api/converter/@from/@to/@price', ['ConverterClass', 'converter']);

Flight::route('POST /api/history/@value', ['HistoryClass', 'history']);
