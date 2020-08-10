<?php
///podstawowe dane
$tytul = 'X';
///słownik w tabelach i formularzu
$nrklienta = 'Nr klienta';
$login = 'Login';
$haslo = 'Hasło';
$imie = 'Imię';
$nazwisko = 'Nazwisko';
$rokzatrudnienia = 'Rok Zatrudnienia';
$rozpoczeciepracy = 'Rozpoczęcie Pracy';
$zakonczeniepracy = 'Zakończenie Pracy';
$rodzajdokumentu = 'Rodzaj Dokumentu';
$waznoscdokumentu = 'Ważność Dokumentu';
$docSpace = 'docSpace';
$ogien = 'Ogień';
$stanwykonania = 'Stan Wykonania';
$przypisanedo = 'Przypisane do';
$dodaneprzez = 'Dodane przez';
$uwagi = 'Uwagi';
$ostatniazmiana = 'Ostatnia Zmiana';
$datadodania = 'Data dodania';
$opisDaty = '<font size="1"><b>Poprawna Struktura</B><br>Data w obu polach musi mieć układ <br><b><u>rrrr-mm-dd gg:mm:ss</b></u><br>W przypadku gdy jest automatyczny kalendarz z wyborem daty nalezy podać dodatkowo godzinę w postaci <b><u>gg:mm</b></u></font>';
$filtr = 'Filtr -';
///pasek nawigacji
$logout = 'Wyloguj się';
$index = 'Wprowadzenie';
$index_a = 'Administracja'; 
$manager = 'Moderator'; 
$userManager = 'Zarządzanie Użytkowinkami';
$piwnica = 'Archiwum';
$viewclient = 'Poszukaj Klienta'; 
$employee = 'Użytkownik'; 
$archive = 'Logi'; 
$monit = 'Sprawdź Monity';
$duplicate = 'Duplikuj';
$stopa = 'X'; 
$archive_monit1 = 'X';
$archive_monit2 = 'X';
$archive_monit3 = 'X';
$BB = 'BigBrother';
///podpowiedzi w oknach
$opis1 = 'X';
$opis2 = 'X';
$opis3 = 'X';
$opis4 = 'X';
$opis5 = 'X';
$opis6 = 'X';
$opis7 = 'X';
///employee
$opisP = '-Przydzielona';
$opisZ = '-Zatrzymana';
$opisW = '-Wykonana';
///employee podpowiedzi okna
$opisPa = 'X';
$opisZa = 'X';
$opisWa = 'X';
///lista krajów
$kraje = '<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'UK. \');">Wielka Brytania</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'DE. \');">Niemcy</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'NO. \');">Norwegia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'NL. \');">Holandia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'BE. \');">Belgia</button><br>-----------------------------------------------------------<br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'AT. \');">Austria</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'PT. \');">Azory</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'BG. \');">Bułgaria</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'HR. \');">Chorwacja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'CY. \');">Cypr</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'CZ. \');">Czechy</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'DK. \');">Dania</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'EE. \');">Estonia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'FI. \');">Finlandia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'FR. \');">Francja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'UK. \');">Gibraltar</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'GR. \');">Grecja</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'FR. \');">Gujana Francuska</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'FR. \');">Gwadelupa</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'ES. \');">Hiszpania</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'IE. \');">Irlandia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'IS. \');">Islandia</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'LI. \');">Lichtenstein</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'LT. \');">Litwa</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'LU. \');">Luksemburg</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'LV. \');">Łotwa</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'PT. \');">Madera</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'MT. \');">Malta</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'FR. \');">Martynika</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'PT. \');">Portugalia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'FR. \');">Reunion</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'RO. \');">Rumunia</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'SK. \');">Słowacja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'SI. \');">Słowenia</button><br>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'CH. \');">Szwajcaria</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'SE. \');">Szwecja</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'HU. \');">Węgry</button>
<button type="button" onclick="AddTo<?php echo $uwagi;?>Input(\'IT. \');">Włochy</button>';
?>
